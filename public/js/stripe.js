$(document).ready(function() {

	var stripe;
	var cardNumber;
	var cardCvc;
	var cardExpiry;

	/* FOR TEST
	var stripe = Stripe('pk_test_6pRNASCoBOKtIshFeQd4XMUh');
	*/

	stripe = Stripe('pk_test_6pRNASCoBOKtIshFeQd4XMUh');
	//var stripe = Stripe('pk_live_PZf8V1lFGP4XQYToVNyQVosj');

	var elements = stripe.elements({locale:'pt'});

	cardNumber = elements.create('cardNumber');
	cardNumber.mount('#card-number');

	cardCvc = elements.create('cardCvc');
	cardCvc.mount('#card-cvc');

	cardExpiry = elements.create('cardExpiry');
	cardExpiry.mount('#card-expiry');

	cardNumber.addEventListener('change', function(event) {
		displayStripeErrors(event);
	});
	
	cardExpiry.addEventListener('change', function(event) {
		displayStripeErrors(event);
	});
		
	/*
	card.addEventListener('change', function(event) {
		var displayError = document.getElementById('card-errors');
		if (event.error) {
			displayError.textContent = 'event.error.message';
		} else {
			displayError.textContent = '';
		}
	});

	*/

	

	/*
	IT DOESNT SEEMS TO HAVE ERROS
	cardCvc.addEventListener('change', function(event) {
		var displayError = document.getElementById('card-errors');
		if (event.error) {
			displayError.textContent = event.error.message;
		} else {
			displayError.textContent = '';
		}
	});
	*/


	function displayStripeErrors (event) {
		var displayError = document.getElementById('card-errors');
		if (event.error) {
			displayError.textContent = event.error.message;
		} else {
			displayError.textContent = '';
		}
	}


	var form = document.getElementById('payment-form');

	form.addEventListener('submit', function(event) {
		event.preventDefault();


		if (!is_valid()) {
			return false;
		}
 		
		var ownerInfo = get_ownerInfo();
			
		stripe.createToken(cardNumber).then(function(result) {
			if (result.error) {
				// Inform the user if there was an error
				var errorElement = document.getElementById('card-errors');
				errorElement.textContent = result.error.message;
			} else {
				// Send the token to your server
				stripeTokenHandler(result.token);
			}
		});

		//$(this).submit();
		return true;

	});

	function is_valid() {
		return true;
	}

	function get_ownerInfo() {
	 	return {
	 		owner: {
				name: $('input[name=cardholder-name]').val(),//'Jenny Rosen',
				/*address: {
					line1: 'Nollendorfstraße 27',
					city: 'Berlin',
					postal_code: '10777',
					country: 'DE',
				},*/
				email: $('input[name=user-email]').val(), //'jenny.rosen@example.com'
			},	
	 	};	
	}

	function stripeSourceHandler(source) {
		// Insert the source ID into the form so it gets submitted to the server
		var form = document.getElementById('payment-form');
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'stripeSource');
		hiddenInput.setAttribute('value', source.id);
		form.appendChild(hiddenInput);


		var hiddenInput_2 = document.createElement('input');
		hiddenInput_2.setAttribute('type', 'hidden');
		hiddenInput_2.setAttribute('name', '3d_secure');
		hiddenInput_2.setAttribute('value', source.card.three_d_secure);
		form.appendChild(hiddenInput_2);

		// Submit the form
		form.submit();
	}


	function stripeTokenHandler(token) {
		// Insert the token ID into the form so it gets submitted to the server
		var form = document.getElementById('payment-form');
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'stripeToken');
		hiddenInput.setAttribute('value', token.id);
		form.appendChild(hiddenInput);

		// Submit the form
		form.submit();
	}

});
function setSource(value) {
	$('input[name=source]').val(value);
	return true;
}