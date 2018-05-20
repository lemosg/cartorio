<?php

namespace App\Lib\Deposit\Stripe;

# GESTORES
use App\Gestores\Deposit\Error;
use App\Gestores\Deposit\Stripe\StripeHandler;

# MODELS
use App\Models\Payment\PaymentApi as ApiModel;
use App\Models\Payment\PaymentCharge as ChargerModel;


use Stripe\Charge as StripeCharge;

class  Charge {

	public function retrieve_charge($credential) {
		$charge =StripeHandler::handle_exception('retrieve_charge', $credential);
		if (!$charge->has_error())
			$this->charge = $charge;
	}

	public function charge($config, $customer_id, $transaction_id) {
		//$customer = $config['customer'];

		$this->convert_value($config);

		$charge =StripeHandler::handle_exception('create_charge', $config);
		#$charge = StripeHandler::handle_exception('create_charge', []);
		
		switch (TRUE) {
			case $charge instanceof StripeCharge: 
				$this->save_charge($charge->id, $customer_id, $transaction_id);
				$this->charge = $charge;
			break;
			
			default: $this->error = $charge; break;
		}			

	}

	public function has_error() {
		if (empty($this->error) && $this->is_succeded())
			return FALSE;

		return TRUE;
	}

	public function is_succeded() {
		if ($this->get_status() != 'succeeded')
			return FALSE;

		return TRUE;
	}

	public function get_status() {
		return $this->charge->status;
	}

	private function save_charge($charge_id, $customer_id, $transaction_id) {
		$config = [
			'charge' => $charge_id, # RETURN FROM STRIPE
			'payment_credential_id' => $customer_id, # ID FOR THE CUSTOMER
			'history_user_transaction_id' => $transaction_id, 
		];

		$new = ChargerModel::create($config);

		if(!$new instanceof ChargerModel)
			return FALSE;

		return TRUE;
	}

	private function convert_value(&$array) {
		if (!empty($array['amount']))
			$array['amount'] = $array['amount'] * 100; # HAS TO BE IN CENTS 
	}

}