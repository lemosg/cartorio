<?php

namespace App\Lib\Deposit\Stripe;

use stdClass;

# GESTORES
/*

use App\Lib\Deposit\Stripe\Customer;
use App\Lib\Deposit\Stripe\Charge;
use App\Lib\Deposit\Stripe\RegularPayment;
use App\Gestores\Deposit\Stripe\SecurityPayment;

*/

use App\Models\User;

/****************
 * 	STRIPE LIB 	*
 ***************/

use Stripe\Stripe as StripeExternalApi;
use Stripe\Charge as ChargeExternalApi;

use Stripe\Error\Card as ErrorCard;
use Stripe\Error\RateLimit  as ErrorRateLimit;
use Stripe\Error\InvalidRequest   as ErrorInvalidRequest;
use Stripe\Error\Authentication   as ErrorAuthentication;
use Stripe\Error\ApiConnection  as ErrorApiConnection;
use Stripe\Error\Base  as ErrorBase;


/* WRAPPER TO HANDLE THE NEEDS OF DEPOSIT PROCESS 

	#1 - GET customer by user->source and retrieve via stripe or SET customer by create via stripe
	#2 - GET customer card or SET new card to charge via stripe
	#3 - CHARGE customer via stripe
*/

class Stripe {

	const API_KEY = "sk_test_BQokikJOvBiI2HlWgH4olfQ2";

	public $customer;
	public $charge;
	public $error;


	/*
	 * INITIALIZE THE CLASS AND TRY TO RETRIEVE THE PREVIOUS CUSTOMER 
	 */
	public function __construct($stripe_token) {
		StripeExternalApi::setApiKey(self::API_KEY);

		$this->token = $stripe_token;
		$this->error = new stdClass;
	}
	


	/* CHARGE LIFE CYCLE */

	public function set_chargeMethod($method) {
		$this->charge = ($method == 'required') ? new SecurityPayment() : new RegularPayment();
	}


	public function charge($value) {

		try {

			$this->charge = ChargeExternalApi::create([
				'amount' => $value * 100,
			    'currency' => 'brl',
			    'description' => 'Cobrança cartório',
			    'source' => $this->token,
			    'capture' => false,
			]);
		} catch(ErrorCard $e) {
			// Since it's a decline, Card will be caught
			$body = $e->getJsonBody();
			$err  = $body['error'];

			$this->error->status = 'Status is: ' . $e->getHttpStatus();
			$this->error->type = 'Type is: ' . $err['type'];
			$this->error->code = 'Code is: ' . $err['code'];
			// param is '' in this case
			if (!empty($err['param']))
				$this->error->param = 'Param is:' . $err['param'];
			$msg = $err['message'];

			$this->error->msg = $msg;
			return FALSE;

		} catch (ErrorRateLimit $e) {
			// Too many requests made to the API too quickly
			$body = $e->getJsonBody();
			$err  = $body['error'];

			$this->error->status = 'Status is: ' . $e->getHttpStatus();
			$this->error->type = 'Type is: ' . $err['type'];
			$this->error->code = 'Code is: ' . $err['code'];
			// param is '' in this case
			if (!empty($err['param']))
				$this->error->param = 'Param is:' . $err['param'];
			$msg = $err['message'];

			$this->error->msg = $msg;
			return FALSE;
		} catch (ErrorInvalidRequest $e) {
			// Invalid parameters were supplied to Stripe's API
						$body = $e->getJsonBody();
			$err  = $body['error'];

			$this->error->status = 'Status is: ' . $e->getHttpStatus();
			$this->error->type = 'Type is: ' . $err['type'];
			$this->error->code = 'Code is: ' . $err['code'];
			// param is '' in this case
			if (!empty($err['param']))
				$this->error->param = 'Param is: ' . $err['param'];
			$msg = $err['message'];

			$this->error->msg = $msg;
			return FALSE;
			return new Error($e->jsonBody['error']['message']);
		} catch (ErrorAuthentication $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
						$body = $e->getJsonBody();
			$err  = $body['error'];

			$this->error->status = 'Status is: ' . $e->getHttpStatus();
			$this->error->type = 'Type is: ' . $err['type'];
			$this->error->code = 'Code is: ' . $err['code'];
			// param is '' in this case
			if (!empty($err['param']))
				$this->error->param = 'Param is: ' . $err['param'];
			$msg = $err['message'];

			$this->error->msg = $msg;
			return FALSE;
		} catch (ErrorApiConnection $e) {
			// Network communication with Stripe failed
						$body = $e->getJsonBody();
			$err  = $body['error'];

			$this->error->status = 'Status is: ' . $e->getHttpStatus();
			$this->error->type = 'Type is: ' . $err['type'];
			$this->error->code = 'Code is: ' . $err['code'];
			// param is '' in this case
			if (!empty($err['param']))
				$this->error->param = 'Param is: ' . $err['param'];
			$msg = $err['message'];

			$this->error->msg = $msg;
			return FALSE;
		} catch (ErrorBase $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
						$body = $e->getJsonBody();
			$err  = $body['error'];

			$this->error->status = 'Status is: ' . $e->getHttpStatus();
			$this->error->type = 'Type is: ' . $err['type'];
			$this->error->code = 'Code is:' . $err['code'];
			// param is '' in this case
			if (!empty($err['param']))
				$this->error->param = 'Param is:' . $err['param'];
			$msg = 'Message is:' . $err['message'];

			$this->error->msg = $msg;
			return FALSE;
		} catch (Exception $e) {
			// Something else happened, completely unrelated to Stripe
						$body = $e->getJsonBody();
			$err  = $body['error'];

			$this->error->status = 'Status is: ' . $e->getHttpStatus();
			$this->error->type = 'Type is:' . $err['type'];
			$this->error->code = 'Code is:' . $err['code'];
			// param is '' in this case
			if (!empty($err['param']))
				$this->error->param = 'Param is:' . $err['param'];
			$msg = 'Message is:' . $err['message'];

			$this->error->msg = $msg;
			return FALSE;
		}

		if (!$this->charge instanceof ChargeExternalApi || $this->charge->status != 'succeeded')
			return FALSE;

		return TRUE;
	}

	public function is_charged() {
		return ! $this->charge->has_error();
	}
}