<style>
    #stripePaymentDetails {
        display: none;
    }
</style>
<h3>{{ trans('booking/pay.securePaymentUsingStripe') }}</h3>
<br>
<fieldset id="stripePaymentDetails">

    <div id="card-element"></div>



    <input id="finalAmount" value="{{ $totalPrice }}" type="hidden" data-stripe="amount" name="amount">

    <input value="{{ $currency }}" type="hidden" name="shopCurrency">

    <input value="{{ $productsDescription }}" type="hidden" data-stripe="productsDescription"
        name="productsDescription">


    <div hidden class="form-group">
        <label>{{ trans('booking/pay.emailAddress') }}:</label>
        <input value="{{ $booking->email or "" }}" class="form-control stripeInput" type="email" id="email"
            name="email">
        <span class="error error-exp-year">{{ trans('booking/pay.enterValidEmail') }}</span>
    </div>



    <div id="card-errors" class="payment-errors"></div>
</fieldset>