stripe.createToken(cardElement).then((token) => {
    console.log("Token:", token);
    stripe.createSource(cardElement).then((source) => {
        console.log("Source:", source);
        stripe.createPaymentMethod('card', cardElement, {
            billing_details: {
                name: "karthika"
            }
        }).then((paymentMethod) => {
            console.log("Payment Method:", paymentMethod);
            $.ajax({
                type: "GET",
                //url: "api/booking/products/"+bookingId,
                url: "/api/paymentintent/" + paymentMethod.paymentMethod.id,
                data: {
                    amount: 150,
                    currency: "sek",
                    description: "Sample booking"
                },
                success: function (response) {
                    console.log("Response:::", response);
                    window.payment_intent_client_secret = response.intent.client_secret;
                    stripe.handleCardPayment(payment_intent_client_secret, {
                        payment_method: paymentMethod.paymentMethod.id, // if you have a clientMethod
                    }).then((b) => {
                        console.log("Auth success::", b);
                        window.authRes = b;
                        var form = document.getElementById('billing-form');
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripe-token');
                        hiddenInput.setAttribute('value', token.token.id);
                        form.appendChild(hiddenInput);
                        var hiddenInput2 = document.createElement('input');
                        hiddenInput2.setAttribute('type', 'hidden');
                        hiddenInput2.setAttribute('name', 'client-secret');
                        if (!b.error) {
                            hiddenInput2.setAttribute('value', payment_intent_client_secret);
                        } else {
                            hiddenInput2.setAttribute('value', '');
                        }
                        form.appendChild(hiddenInput2);

                        form.submit();

                    }).catch((e) => {
                        console.log("Auth error::", e);
                    });

                },
                error: function (error) {
                    console.log("eror:::", error);
                },
                dataType: "json"
            });
        }).catch();
    }).catch();
}).catch();