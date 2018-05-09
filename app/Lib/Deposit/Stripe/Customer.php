<?php

namespace App\Gestores\Deposit\Stripe;

# STRIPE
use Stripe\Customer as StripeCustomer;

# GESTORES
use App\Gestores\Deposit\Error;
use App\Gestores\Deposit\Stripe\StripeHandler;
use App\Gestores\Users\User;

# MODELS
use App\Models\Payment\PaymentApi as ApiModel;
use App\Models\Payment\PaymentCredential as CustomerModel;

class  Customer {

	public function get_defaultSource() {
		return $this->customer->default_source;
	}

	public function is_empty() {
		if (!empty($this->customer))
			return FALSE;

		return TRUE;
	}

	public function get_credential() {
		return $this->customer->id;
	}

	public function get_chargeableSource($fingerprint) {
		foreach ($this->customer->sources->data as $source) {
			if ($source->object == 'source') {

				if ($source->card->fingerprint == $fingerprint)
					return $source->id;
			} else {
				if ($source->fingerprint == $fingerprint)
					return $source->id;
			}

		}

		return FALSE;
	}

	public function has_sources() {
		if (empty($this->customer->sources->data))
			return FALSE;

		return TRUE;
	}

	public function retrieve_customer($credential) {
		$customer = StripeHandler::handle_exception('retrieve_customer', $credential);

		switch (TRUE) {
			case $customer instanceof StripeCustomer: $this->customer = $customer; break;
			
			default: $this->error = $customer; break;
		}
	}

	public function append_newCard($card) {
		$this->current_source = $card;

		# append via API the new card
		$this->customer->sources->create(["source" => $card]);

	}

	public function has_error() {
		if (empty($this->error))
			return FALSE;

		return TRUE;
	}

	public function retrieve_customerByUser($user_id) {
		$customer = CustomerModel::where(['user_id' => $user_id, 'payment_api_id' => $this->api->id ])->first();

		if (!$customer instanceof CustomerModel)
			return FALSE;

		$this->retrieve_customer($customer->credential);
	}

	public function set_newCustomer($source, User $user) {
		$customerConfig = [
			"email" => $user->email,
			"source" => $source,
		];

		$customer = StripeHandler::handle_exception('create_customer', $customerConfig);

		if ($customer !== FALSE)
			$this->save_customer($customer, $user->id); # IF EVERYTHING WORKS FINE WE SHOULD SAVE THE CUSTOMER TO FUTURE REUSE

		$this->customer = $customer;
	}

	protected function save_customer(StripeCustomer $customer, $user_id) {
		$config = [
			'credential' => $customer->id,
			'user_id' => $user_id,
			'payment_api_id' => ApiModel::get_stripe()->id,
		];

		$new = CustomerModel::create($config);

		if(!$new instanceof CustomerModel)
			return FALSE;

		return TRUE;
	}	

}
