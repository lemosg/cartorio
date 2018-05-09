<?php

namespace App\Gestores\Deposit\Stripe;


# GESTORES
use App\Gestores\Deposit\Stripe\Customer;
use App\Gestores\Deposit\Stripe\Charge;
use App\Gestores\Deposit\Stripe\RegularPayment;
use App\Gestores\Deposit\Stripe\SecurityPayment;

use App\Models\User;

/****************
 * 	STRIPE LIB 	*
 ***************/

use Stripe\Stripe as StripeExternalApi;


/* WRAPPER TO HANDLE THE NEEDS OF DEPOSIT PROCESS 

	#1 - GET customer by user->source and retrieve via stripe or SET customer by create via stripe
	#2 - GET customer card or SET new card to charge via stripe
	#3 - CHARGE customer via stripe
*/

class Stripe {

	const API_KEY = "sk_test_BQokikJOvBiI2HlWgH4olfQ2";

	public $new = FALSE;
	public $customer;
	public $charge;


	/*
	 * INITIALIZE THE CLASS AND TRY TO RETRIEVE THE PREVIOUS CUSTOMER 
	 */
	public function __construct() {
		StripeExternalApi::setApiKey(self::API_KEY);
		$this->customer = new Customer();
		
		$this->user = $user;

		if (!empty($this->user->stripe_customer))
			$this->get_previousCustomer($user->stripe_customer);
	}

	
	/* CUSTOMER LIFE CYCLE */

	/*
	 * IF THERE IS A USER CUSTOMER FOR THIS API 
	 * GET IT AND TRY TO RETRIEVE
	 * IF NOT GENERATES A NEW ONE
	 */

	# MAGIC FUNCTION 

	public function setup_payment($source) {
		$fingerprint = $this->find_fingerprint($source);
		
		if ($fingerprint === FALSE)
			$fingerprint = $this->append_source($source);

		$this->fingerprint = $fingerprint;
	}

	public function find_fingerprint($fingerprint) {
		$default = $this->customer->get_defaultSource()
		;
		if ($fingerprint == 'new' || $fingerprint == $default)
			return $default;

		if (!$this->customer->has_sources())
			return FALSE;

		return $this->customer->get_chargeableSource($fingerprint);
	}

	public function append_card($card) {
		$this->customer->append_newCard($card);
	}

	public function set_customer($source) {
		if (!$this->customer->is_empty())
			return 'ERRO criando novo customer quando ja existe um';
		
		$this->customer->set_newCustomer($source, $this->user);
	}

	public function is_customerEmpty() {
		if (!$this->customer->is_empty())
			return FALSE;

		return TRUE;
	}


	/*
	public function retrieveAndSet_customer ($credential) {
		$customer = $this->retrieve_customer($credential);
		$this->set_customer($customer);
	}
	*/
	


	/* SUPPORT METHODS */
	private function get_previousCustomer($stripe_customer) {
		if (!empty($stripe_customer->credential))
			$this->customer->retrieve_customer($stripe_customer->credential);
	}

	


	/* CHARGE LIFE CYCLE */

	public function set_chargeMethod($method) {
		$this->charge = ($method == 'required') ? new SecurityPayment() : new RegularPayment();
	}


	public function charge($charge, $transaction_id) {
		$charge['customer'] = $this->customer->get_credential();
		$charge["source"] = $this->fingerprint;

		$this->charge = new Charge();
		$this->charge->charge($charge, $this->user->stripe_customer->id, $transaction_id);
	}

	public function is_charged() {
		return ! $this->charge->has_error();
	}
}