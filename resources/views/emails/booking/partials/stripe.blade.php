<style>
    #stripePaymentDetails
    {
        display: none;
    }
</style>
    <fieldset id="stripePaymentDetails">
        <div class="form-group">
            <label>Card Number:</label>
            <input class="form-control invalid_number stripeInput" type="text" data-stripe="number">
            <span class="error error-number invalid_number">Please enter a valid card number</span>
        </div>

        <div class="form-group">
            <label>CVC:</label>
            <input class="form-control stripeInput invalid_cvc" type="text" data-stripe="cvc">
            <span class="error error-cvc invalid_cvc">Please enter a cvv number</span>
        </div>

        <input id="finalAmount" value="{{ $totalPrice }}" type="hidden" data-stripe="amount" name="amount">

        <input value="{{ $currency }}" type="hidden" name="shopCurrency">

        <input value="{{ $productsDescription }}" type="hidden" data-stripe="productsDescription" name="productsDescription">

        <div class="form-group">
            <label>Expiration Date:</label>

            {!! Form::selectMonth(null, null, ['data-stripe' => 'exp-month', 'class' => "stripeInput error form-control invalid_expiry_month"]) !!}
            <span class="error error-exp_month invalid_expiry_month">Please enter a valid expiry month</span>
            {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, ['data-stripe' => 'exp-year', 'class' => "stripeInput error form-control invalid_expiry_year"]) !!}
            <span class="error error-exp_year invalid_expiry_year">Please enter a valid expiry year</span>

        </div>

        <div class="form-group">
            <label>Email Address:</label>
            <input value="{{ $booking->email or "" }}" class="form-control stripeInput" type="email" id="email" name="email">
            <span class="error error-exp-year">Please enter your email address</span>
        </div>

        <div class="payment-errors"></div>
    </fieldset>