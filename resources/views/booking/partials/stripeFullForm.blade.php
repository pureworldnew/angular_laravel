<style>
    #stripePaymentDetails
    {
        display: none;
    }
</style>
<div class="row" id="stripePaymentDetails">
    {!! Form::open(['id' => 'billing-form', "class" => "form-horizontal", 'url'=>route('booking.stripePayment'), 'method' => 'post'])  !!}

        <div class="form-group">
            <label class="col-sm-3 control-label">Card Number:</label>
            <div class="col-sm-5">
                <input class="form-control" type="text" data-stripe="number">
            </div>
            <div class="col-sm-4">
                <span class="error error-number">Please enter a card number</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">CVC:</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" data-stripe="cvc">
            </div>
            <div class="col-sm-4">
                <span class="error error-cvc">Please enter a cvv number</span>
            </div>
        </div>

        <input id="finalAmount" value="{{ $totalPrice }}" type="hidden" data-stripe="amount" name="amount">

        <input value="{{ $currency }}" type="hidden" name="shopCurrency">

        <input value="{{ $productsDescription }}" type="hidden" data-stripe="productsDescription" name="productsDescription">

        <div class="form-group">
            <label class="col-sm-3 control-label">Expiration Date:</label>
            <div class="col-sm-4">
                {!! Form::selectMonth(null, null, ['data-stripe' => 'exp-month', 'class' => "form-control"]) !!}
                <span class="error error-exp_month">Please enter an expiry month</span>
                {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, ['data-stripe' => 'exp-year', 'class' => "form-control"]) !!}
                <span class="error error-exp_year">Please enter an expiry year</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Email Address:</label>
            <div class="col-sm-5">
                <input class="form-control" type="email" id="email" name="email">
            </div>
            <div class="col-sm-4">
                <span class="error error-exp-year">Please enter your email address</span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3 "></div>
            <div class="col-sm-5">
                {!! Form::submit('Buy Now', ['ng-click' => 'submitStripe($event)', 'ng-value' => 'submitStripeButtonText', 'ng-disabled' => 'disableStripeButton', 'class' => 'shopButton']) !!}
            </div>
        </div>

        <div class="payment-errors"></div>
    {!! Form::close() !!}
</div>