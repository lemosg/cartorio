<?php

namespace App\Lib\Deposit\Stripe;

use Stripe\Source;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;


# EXCEPTIONS 
use Stripe\Error\Card as ErrorCard;
use Stripe\Error\RateLimit as ErrorRateLimit;
use Stripe\Error\InvalidRequest as ErrorInvalidRequest;
use Stripe\Error\Authentication as ErrorAuthentication;
use Stripe\Error\ApiConnection as ErrorApiConnection;
use Stripe\Error\Base as ErrorBase;


class SecurityPayment {
	
	public function __construct($user, $src){
		$this->user = $user;
		$this->source = $src;
	}
	
	private function charge($charge){

		$paymentData = [
			"amount" => 1099,
			"currency" => "usd",
			"type" => "three_d_secure",
			"three_d_secure" => [
			"card" => $this->source,
			],
			"redirect" => [
			"return_url" => "https://shop.example.com/crtA6B28E1"
			],
		];

		try {
			$source = Source::create($paymentData);
		} catch(ErrorCard $e) {
			// Since it's a decline, Card will be caught
			$body = $e->getJsonBody();
			$err  = $body['error'];

			print('Status is:' . $e->getHttpStatus() . "\n");
			print('Type is:' . $err['type'] . "\n");
			print('Code is:' . $err['code'] . "\n");
			// param is '' in this case
			print('Param is:' . $err['param'] . "\n");
			print('Message is:' . $err['message'] . "\n");
		} catch (ErrorRateLimit $e) {
			// Too many requests made to the API too quickly
			echo 'rate';
		} catch (ErrorInvalidRequest $e) {
			// Invalid parameters were supplied to Stripe's API
			echo 'request';
		} catch (ErrorAuthentication $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			echo 'Authentication';
		} catch (ErrorApiConnection $e) {
			// Network communication with Stripe failed
			echo 'conection';
		} catch (ErrorBase $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
			echo 'generic';
		} catch (Exception $e) {
			// Something else happened, completely unrelated to Stripe
			echo 'bolacha';
		}

	}
	
}