// Create a Stripe client.
const stripe = Stripe(stripepub, {
				  betas: ["payment_intent_beta_3"]
				});
var displayError = document.getElementById("checkout-errormsg");

const return_url = confirmationUrl;

const paymentMethodss = {
  /* paypal: {
      name: 'Paypal',
      flow: 'receiver',
      countries: ['US'],
      currencies: 'usd',
  },
  card: {
      name: 'Bank Transfer',
      flow: 'receiver',
      countries: ['US'],
      currencies: 'usd',
  }, */
  bancontact: {
    name: 'Bancontact',
    flow: 'redirect',
    countries: ['BE'],
    currencies: 'eur',
  },
  ideal: {
    name: 'iDEAL',
    flow: 'redirect',
    countries: ['NL'],
    currencies: 'eur',
  },
  giropay: {
    name: 'Giropay',
    flow: 'redirect',
    countries: ['DE'],
    currencies: 'eur',
  },
  sepa_debit: {
    name: 'SEPA Direct Debit',
    flow: 'none',
    countries: ['FR', 'DE', 'ES', 'BE', 'NL', 'LU', 'IT', 'PT', 'AT', 'IE', 'FI'],
    currencies: ['eur'],
  },
  sofort: {
    name: 'SOFORT',
    flow: 'redirect',
    countries: ['DE', 'AT'],
    currencies: 'eur',
  },
};


// Prepare the styles for Elements.
const paystyle = {hidePostalCode: true,
style: {
    base: {
      iconColor: '#666ee8',
      color: '#31325f',
      fontWeight: 400,
      fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '15px',
      '::placeholder': {
          color: '#aab7c4',
      },
      ':-webkit-autofill': {
          color: '#666ee8',
      },
  },
  }};

// Create an instance of Elements.
const elements = stripe.elements();
let card, iban, idealBank;
const stripeForm = document.querySelector('.stripe-option-form');
const stripeFormEl = stripeForm.querySelectorAll('input[type=radio]');
stripeFormEl.forEach(function (optionEl) {
	
  optionEl.addEventListener('click', event => {
	  if(event.target.value == 'Stripe')
		  event.target.value = 'card';

	  if(event.target.value == 'Paypal'){
		  event.target.value = 'paypal';
		  $("#billing_email").show();

	  }
    console.log("=============")
    console.log(event.target.value)
	  
    selectPaymentOption(event.target.value)
  });
});

selectPaymentOption('card');

function changeShippingTo(shipBox) {
	var  paymentMethods = {
  bancontact: {
    name: 'Bancontact',
    flow: 'redirect',
    countries: ['BE'],
    currencies: 'eur',
  },
  ideal: {
    name: 'iDEAL',
    flow: 'redirect',
    countries: ['NL'],
    currencies: 'eur',
  },
  giropay: {
    name: 'Giropay',
    flow: 'redirect',
    countries: ['DE'],
    currencies: 'eur',
  },
  sepa_debit: {
    name: 'SEPA Direct Debit',
    flow: 'none',
    countries: ['FR', 'DE', 'ES', 'BE', 'NL', 'LU', 'IT', 'PT', 'AT', 'IE', 'FI'],
    currencies: ['eur'],
  },
  sofort: {
    name: 'SOFORT',
    flow: 'redirect',
    countries: ['DE', 'AT'],
    currencies: 'eur',
  },
};
  const shippingTo = shipBox;

  const stripeOptionEls = document.querySelectorAll('.stripe-option');
  stripeOptionEls.forEach(function (item) {
    item.classList.remove('active')
  })
  let keys = Object.keys(paymentMethods);
  for (var i = 0; i < keys.length; i++) {
    let key = keys[i],
      type = paymentMethods[key];
    const countries = type.countries;
	//console.log(countries);
    //console.log(key, countries.indexOf(shippingTo))
    if (countries.indexOf(shippingTo) != -1) {
      document.querySelector('.' + key).classList.add('active');
    }
  }
}

function selectPaymentOption(paymentOption) {
		 $("#billing_email").hide();
    // alert(paymentOption)
  const payoptEl = document.querySelectorAll('.payment-option-info');
  payoptEl.forEach(function (item) {
    item.classList.add('elhide')
  })
  console.log('.' + paymentOption + '-option-info')
  document.querySelector('.' + paymentOption + '-option-info').classList.remove('elhide')
  document.querySelector('.' + paymentOption + '-option-title').classList.remove('elhide')
  if(paymentOption == 'paypal'){
		              $("#billing_email").show();
	}
  if(paymentOption == "card" && !card) {
    // Create a Card Element and pass some custom styles to it.
    card = elements.create('card', { paystyle });
    
    // Mount the Card Element on the page.
    card.mount('#card-element');

    // Monitor change events on the Card Element to display any errors.
    card.on('change', ({ error }) => {
        const cardErrors = document.querySelector('.' + paymentOption + '-option-info .errmsg');
        if (error) {
            cardErrors.textContent = error.message;
            cardErrors.classList.remove('elhide');
        } else {
            cardErrors.classList.add('elhide');
        }
    });
  }

  if (paymentOption == "sepa_debit" && !iban) {
    // Create a IBAN Element and pass the right options for styles and supported countries.
    const ibanOptions = {
      paystyle,
      supportedCountries: ['SEPA'],
    };
    iban = elements.create('iban', ibanOptions);

    // Mount the IBAN Element on the page.
    iban.mount('#iban-element');

    // Monitor change events on the IBAN Element to display any errors.
    iban.on('change', ({ error, bankName }) => {
      const ibanErrors = document.querySelector('.' + paymentOption + '-option-info .errmsg');
      if (error) {
        ibanErrors.textContent = error.message;
        ibanErrors.classList.remove('elhide');
      } else {
        ibanErrors.classList.add('elhide');
      }
    });
  }

  if(paymentOption == "ideal" && !idealBank){
    // Create a iDEAL Bank Element and pass the style options, along with an extra `padding` property.
    idealBank = elements.create('idealBank', {
        style: { base: Object.assign({ padding: '10px 15px' }, paystyle.base) },
    });

    // Mount the iDEAL Bank Element on the page.
    idealBank.mount('#ideal-bank-element');
  }
}

function proceedPayment(){
	const ordervalue = document.querySelector('input[name="ordervalue"]').value,
    form = document.getElementById('billing-form'),
    email = document.querySelector('input[name="billing_email"]').value,
    shipping_country = form.querySelector('input[name="shipping_country"]').value,
    paymentOption = document.querySelector('input[name="paymentMethod"]:checked').value,
    firstname = form.querySelector('input[name="name"]').value,
    lastname = '',
    postal_code = form.querySelector('input[name="post_code"]').value,
    locality = form.querySelector('input[name="city"]').value,
    address1 = document.querySelector('input[name="address"]').value,
    address2 = '',
    name = firstname;

	
  const errmsg = document.querySelector('.checkout-errormsg');
  errmsg.textContent = "";
  if(!email){
    errmsg.textContent = "Please enter the Email ID";
    return false;
  } else if(!shipping_country){
    errmsg.textContent = "Please select the Shipping To";
    return false;
  } else if(!firstname){
    errmsg.textContent = "Please enter the First Name";
    return false;
  } else if(!postal_code){
    errmsg.textContent = "Please enter the Postal Code";
    return false;
  } else if(!locality){
    errmsg.textContent = "Please enter the Locality";
    return false;
  }
  const metadata = {
    firstname : firstname,
    lastname: lastname,
    email: email,
    shippingto: shipping_country,
    postal_code: postal_code,
    locality: locality,
    address1: address1,
    address2: address2,
    paytype: paymentOption,
    amount: ordervalue
  } 


  const proceedBtn = document.querySelector('#proceedBtn');
  let source;
  
  /* if(paymentOption == "card"){
    source = card;
    stripe.createToken(source).then(paymentTokenCallback);
  } else if(paymentOption == "sepa_debit"){
    source = iban;
    stripe.createToken(source, {
      currency: 'eur'
    }).then(paymentTokenCallback);
  } else if(paymentOption == "ideal") {
    source = idealBank;
    stripe.createToken(source).then(paymentTokenCallback);
  } else {

  } */
//alert(paymentOption);
  if(paymentOption == "Stripe" || paymentOption == "card"){
   /*  const source = stripe.createSource(card, {
      owner: {
        name,
        email
      },
      metadata: metadata
    }).then(paymentSourceCallback); */
	var clientSecret = proceedBtn.dataset.secret;

	   stripe.handleCardPayment(
		clientSecret, card, {
		  source_data: {
			owner: {name: name,
					email: email}
		  }
		}
	  ).then(function(result) {
		if (result.error) {
			  errmsg.textContent = result.error.message;
		} else {
				 form.submit(); 

		}
	  });
  }
  else if(paymentOption == "Cash"){
    form.submit()
  }
   else if(paymentOption == "sepa_debit"){
    const source = stripe.createSource(iban, {
      type: 'sepa_debit',
      amount: ordervalue,
      currency: 'eur',
      owner: {
        name,
        email,
      },
      mandate: {
        // Automatically send a mandate notification email to your customer
        // once the source is charged.
        notification_method: 'email',
      }
    }).then(paymentSourceCallback);
  } else if(paymentOption == "ideal") {
    const source = stripe.createSource(idealBank, {
      type: 'ideal',
      amount: ordervalue,
      currency: 'eur',
      owner: {
        name,
        email,
      },
      metadata: metadata,
      // Specify the URL to which the customer should be redirected
      // after paying.
      redirect: {
        return_url: return_url,
      }
    }).then(paymentSourceCallback);
  } else if(paymentOption == "sofort" || paymentOption == "giropay" || paymentOption == "bancontact") {
    stripe.createSource({
      type: paymentOption,
      amount: ordervalue,
      owner: {
        name,
        email,
      },
      metadata: metadata,
      currency: 'eur',
      redirect: {
        return_url: return_url,
      },
      sofort: {
        country: shipping_country,
      },
    }).then(paymentSourceCallback);
  } else if(paymentOption == "paypal"){
    const paypalForm = document.getElementById("paypal_checkout"),
      lcfld = paypalForm.querySelector('input[name=lc]'),
      currency_code = paypalForm.querySelector('input[name=currency_code]');

      lcfld.value = shipping_country;

    paypalForm.querySelector('input[name=email]').value = email;
    paypalForm.querySelector('input[name=first_name]').value = firstname;
    paypalForm.querySelector('input[name=last_name]').value = lastname;
    paypalForm.querySelector('input[name=address1]').value = address1;
    paypalForm.querySelector('input[name=address2]').value = address2;
    paypalForm.querySelector('input[name=zip]').value = postal_code;
    paypalForm.querySelector('input[name=city]').value = locality;
    paypalForm.querySelector('input[name=country]').value = shipping_country;
    
    const customjson = {
     'email':email,
     'firstname': firstname,
     'lastname': lastname
    }
    customstr = JSON.stringify(customjson)
    paypalForm.querySelector('input[name=custom]').value = customstr;
    document.getElementById("paypal_checkout").submit();
  }
  
}

function paymentSourceCallback(result) {
  const proceedBtn = document.querySelector('#proceedBtn'),
    errmsg = document.querySelector('.checkout-errormsg');
  //proceedBtn.value = "Proceed";
  if(result.error){
    errmsg.textContent = result.error.message;
    proceedBtn.value = "Proceed";
  }else{
    const source = result.source;
    switch (source.status) {
      case 'chargeable':
        chargeCardPayment(source)
        break;
      case 'pending':
        switch (source.flow) {
          case 'none':
            console.log('Unhandled none flow.', source);
            break;
          case 'redirect':
            // Immediately redirect the customer.
            proceedBtn.value = 'Redirecting…';
            window.location.replace(source.redirect.url);
            break;
          case 'code_verification':
            // Display a code verification input to verify the source.
            break;
          default:
            // Order is received, pending payment confirmation.
            break;
        }
        break;
      case 'failed':
      case 'canceled':
        // Authentication failed, offer to select another payment method.
        break;
      default:
        // Order is received, pending payment confirmation.
        break;
    }
  }
}

function chargeCardPayment(source){
  document.querySelector("input[name=stripe_source]").value = JSON.stringify(source);
  document.forms[0].submit();
}