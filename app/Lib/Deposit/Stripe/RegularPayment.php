<?php

namespace App\Gestores\Deposit\Stripe;

use App\Gestores\Deposit\Stripe\StripeHandler;


/* ‎4242 4242 4242 4242 */

class RegularPayment {
	
	public function charge($value, $customer_key, $user_id, $source) {

		#$config["statement_descriptor"] = "Custom descriptor";

		$config["customer"] = $customer_key;
		$config["source"] = $this->source;

		$charge = $this->handle_exception('create_charge', $config);
		if ($charge !== FALSE)
			$this->save_charge($charge);
	}

}