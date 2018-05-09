<?php

namespace App\Gestores\Deposit\Stripe;

/****************
 * 	STRIPE LIB 	*
 ***************/

use Stripe\Source;
use Stripe\Customer;
use Stripe\Charge;


# EXCEPTIONS 
use Stripe\Error\Card as ErrorCard;
use Stripe\Error\RateLimit as ErrorRateLimit;
use Stripe\Error\InvalidRequest as ErrorInvalidRequest;
use Stripe\Error\Authentication as ErrorAuthentication;
use Stripe\Error\ApiConnection as ErrorApiConnection;
use Stripe\Error\Base as ErrorBase;

/************
 * SPM USES *
 ***********/

use App\Gestores\Deposit\Error;



abstract class StripeHandler {

	/* THE HANDLE FOR ALL STRIPE CALLS */
	public static function handle_exception($function, $parameters) {
		$success = FALSE;

		# THIS SHOULD YOUSE TRY CATCH OR IT CAN CREATE BAD UX
		try {
			switch($function) {
				# CUSTOMER
				case 'create_customer': $success = Customer::create($parameters); break;
				case 'retrieve_customer': $success = Customer::retrieve($parameters); break;
				
				# CHARGE
				case 'create_charge': $success = Charge::create($parameters); break;
			}

		} catch(ErrorCard $e) {
			// Since it's a decline, Card will be caught
			$body = $e->getJsonBody();
			$err  = $body['error'];

			$msg = '';

			$msg .= 'Status is:' . $e->getHttpStatus() . "\n";
			$msg .= 'Type is:' . $err['type'] . "\n";
			$msg .= 'Code is:' . $err['code'] . "\n";
			// param is '' in this case
			if (!empty($err['param']))
				$msg .= 'Param is:' . $err['param'] . "\n";
			$msg .= 'Message is:' . $err['message'] . "\n";


			return new Error($msg);

		} catch (ErrorRateLimit $e) {
			// Too many requests made to the API too quickly
			$msg = 'rate';
			return new Error($msg);
		} catch (ErrorInvalidRequest $e) {
			// Invalid parameters were supplied to Stripe's API
			
			return new Error($e->jsonBody['error']['message']);
		} catch (ErrorAuthentication $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			$msg = 'Authentication';
			return new Error($msg);
		} catch (ErrorApiConnection $e) {
			// Network communication with Stripe failed
			$msg = 'conection';
			return new Error($msg);
		} catch (ErrorBase $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
			$msg = 'generic';
			return new Error($msg);
		} catch (Exception $e) {
			// Something else happened, completely unrelated to Stripe
			$msg = 'bolacha';
			return new Error($msg);
		}

		return $success;
	}	
}