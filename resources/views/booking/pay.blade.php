@extends('app')

@section('content')

    <link href="{{ asset('/css/cart.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/payments.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
	<script>
		var stripepub = '{{$centreStripePublicKey}}'; 
	</script>
<style>
    #confirmNavBox {
        margin-top: 200px;
    }
	#card-element{
		width: 493px !important;
	}
    #paymentBox input[type=text],
    #paymentBox select {
        margin-top: 10px;
    }

    .paymentMethods li {
        list-style: none;
		border: 1px solid #b5b5b5;
		margin-top: 12px;
    }

    #klarna-checkout-container {
        display: none;
    }

    #billing-form span.error {
        display: none;
        color: red;
    }
#iban-element {
    width: 300px;
}
    #card-element {
        padding: 10px;
       
    }
	
	.stripe-option{
		display:none;
	}
			.store_hours {
			margin-bottom: 10px;
		}
		.store_hours p {
			padding: 0;
			margin: 0;
		}
		.store_name {
			text-transform: capitalize;
			font-size: 35px;
		}
</style>
<div class="row">
    <div class="col-xs-12 col-sm-10-4 col-md-6 contentBoxHolder">
        <div id="paymentBox" class="contentBox">
			<div class="store_name">{{$klarnaDetails->name}}</div>
	<div class="store_hours">
	
	<p>Opening Hours : <?php 
	$date = new DateTime($klarnaDetails->startTime.' 06/13/2013');
	echo $date->format('h:i A') ; ?></p>
    <p>Closing Hours : <?php 
	$date = new DateTime($klarnaDetails->endTime.' 06/13/2013');
	echo $date->format('h:i A') ; ?></p>
	</div>
            @include("partials.bookingBreadcrumbs")

            {!! Form::open(array('url' => '/booking/confirmation', "id" => "billing-form","class" => "form form-payment-stripe form-order-checkout")) !!}
	   <div class="form-item form-type-radios form-name-payment-values">
        <div class="form-input stripe-option-form">
            @if(!$centre->klarna_only)
            <div class="form-group hidden">

                <h3 class="shipping-label thin">{{ trans('booking/pay.customerType') }} </h3>
				 <label class="form-label radio-label">
					<input id="customerTypeIndividual" type="radio"  class="form-radio"  name="customerType" value="2" checked />
					<span class="fa fa-circle radio-icon-unchecked"></span>
					<span class="fa fa-check-circle radio-icon-checked"></span>
					<span class="label-inner">{{ trans('booking/pay.customerTypeIndividual') }}
					</span>
				 </label>

				 <label class="form-label radio-label">
					<input id="customerTypeCompany" type="radio"  class="form-radio"  name="customerType" value="1"  />
					<span class="fa fa-circle radio-icon-unchecked"></span>
					<span class="fa fa-check-circle radio-icon-checked"></span>
					<span class="label-inner"> {{ trans('booking/pay.customerTypeCompany') }}
					</span>
				 </label>
            </div>

            @if(sizeof($paymentMethods) == 0)
            <h2 style="color:red">{{ trans('booking/pay.noPaymentMethodsHead') }}</h2>
            <p>{{ trans('booking/pay.noPaymentMethodsText') }}</p>
            @elseif(sizeof($paymentMethods) ==1)
            <ul class="paymentMethods">
                @foreach($paymentMethods as $method)
                <li>
					<label class="form-label radio-label">
						<input id="paymentMethod{{$method->shortName}}" type="radio"  class="form-radio paymentMethod"  name="paymentMethod" checked value="{{$method->shortName}}"  />
						<span class="fa fa-circle radio-icon-unchecked"></span>
						<span class="fa fa-check-circle radio-icon-checked"></span>
						<span class="label-inner"> {{ trans('booking/pay.payment'.$method->shortName) }}
						</span>
					</label>
				</li>
                @endforeach
            </ul>
            @else
            <h3 class="shipping-label thin">{{ trans('booking/pay.paymentMethodHeading') }}</h3>
            <ul class="paymentMethods">s
                @foreach($paymentMethods as $method)
                <li>
				<label class="form-label radio-label">
				{{ Form::radio('paymentMethod', $method->shortName, false, array('checked' => true, 'class' => 'form-radio paymentMethod', 'id' => 'paymentMethod'.$method->shortName)) }}
						<span class="fa fa-circle radio-icon-unchecked"></span>
						<span class="fa fa-check-circle radio-icon-checked"></span>
						<span class="label-inner"> {{ trans('booking/pay.payment'.$method->shortName) }}
						<div class="radio-line">{{ trans('booking/pay.description'.$method->shortName) }}</div>
						</span>
				</label>
						
				</li>
                @if($method->shortName == 'Transfer')
                <p id="paymentTransferHow" class="paymentHow" style="display:none">{{ $paymentTransferHow }}</p>
                @elseif($method->shortName == 'Cash')
                <p id="paymentCashHow" class="paymentHow" style="display:none">{{ $paymentCashHow }}</p>
                @elseif($method->shortName == 'Invoice')
                <p id="paymentInvoiceHow" class="paymentHow" style="display:none">{{ $paymentInvoiceHow }}</p>
                @endif
                @endforeach
				
				  <label class="form-label radio-label stripe-option bancontact">
					<input type="radio" name="paymentMethod" class="form-radio" value="bancontact">
					<span class="fa fa-circle radio-icon-unchecked"></span>
					<span class="fa fa-check-circle radio-icon-checked"></span>
					<span class="label-inner">BANCONTACT (Powered by Stripe)
					  <div class="radio-line">You’ll be redirected to the banking site to complete your payment.</div>
					</span>
				  </label>
				  <label class="form-label radio-label stripe-option sepa_debit">
					<input type="radio" name="paymentMethod" class="form-radio" value="sepa_debit">
					<span class="fa fa-circle radio-icon-unchecked"></span>
					<span class="fa fa-check-circle radio-icon-checked"></span>
					<span class="label-inner">SEPA DIRECT DEBIT (Powered by Stripe)
					  <div class="radio-line">Pay with Sepa Direct Debit with stripe.</div>
					</span>
				  </label>
				  <label class="form-label radio-label stripe-option giropay">
					<input type="radio" name="paymentMethod" class="form-radio" value="giropay">
					<span class="fa fa-circle radio-icon-unchecked"></span>
					<span class="fa fa-check-circle radio-icon-checked"></span>
					<span class="label-inner">GIROPAY (Powered by Stripe)
					  <div class="radio-line">You’ll be redirected to the banking site to complete your payment.</div>
					</span>
				  </label>
				  <label class="form-label radio-label stripe-option sofort">
					<input type="radio" name="paymentMethod" class="form-radio" value="sofort">
					<span class="fa fa-circle radio-icon-unchecked"></span>
					<span class="fa fa-check-circle radio-icon-checked"></span>
					<span class="label-inner">SOFORT (Powered by Stripe)
					  <div class="radio-line">You’ll be redirected to the banking site to complete your payment.</div>
					</span>
				  </label>
				  <label class="form-label radio-label stripe-option ideal">
					<input type="radio" name="paymentMethod" class="form-radio" value="ideal">
					<span class="fa fa-circle radio-icon-unchecked"></span>
					<span class="fa fa-check-circle radio-icon-checked"></span>
					<span class="label-inner">IDEAL (Powered by Stripe)
					  <div class="radio-line">Select Bank and You’ll be redirected to the banking site to complete your payment.</div>
					</span>
				  </label>
            </ul>
            @endif
            @endif
		</div>
	</div>
            <h3 class="addressDetails">{{ trans('booking/pay.customerDetails') }}: </h3>
            <div id="billing_name" class="form-group">
                <label for="name">{{ trans('booking/pay.name') }}:</label>
                <input value="{{ $booking->name }}" name="name" type="text" class="form-control input"
                    placeholder="{{ trans('booking/pay.name') }}"><br>
            </div>

        

            <div class="form-group addressDetails">
                <label for="exampleInputEmail1">{{ trans('booking/pay.address') }}:</label><BR>
                <input name="address" value="{{ $booking->address }}" type="text" class="form-control input"
                    placeholder="{{ trans('booking/pay.yourAddress') }}"><BR>
                <input name="address" value="{{ $booking->address2 }}" type="text" class="form-control input"
                    placeholder="{{ trans('booking/pay.yourAddress2') }}"><BR>
                <input name="city" value="{{ $booking->city }}" type="text" class="form-control input"
                    placeholder="{{ trans('booking/pay.city') }}"><BR>
                <input name="post_code" value="{{ $booking->post_code }}" type="text" class="form-control input"
                    placeholder="{{ trans('booking/pay.postcode') }}"><BR>
					 <input name="country" value="{{ $booking->bookingcountry }}" type="text" class="form-control input"
                    placeholder="Country"><BR>
                <input name="phone" value="{{ $booking->telephone }}" type="text" class="form-control input"
                    placeholder="{{ trans('booking/pay.phone') }}"><BR>

            </div>

              <div class="shipping-label stroke secure-label">
                Secure payment
              </div>
              <div class="card-label card-option-title payment-option-info">
                Card information
              </div>
              <div class="form-item form-type-container form-name-card-container card-option-info payment-option-info">
  
                <fieldset>
                    <label>
                        <span>Card</span>
                        <div id="card-element" class="field"></div>
                    </label>
                </fieldset>
                <div class="errmsg elhide"></div>
              </div>
              <div class="card-label paypal-option-title payment-option-info elhide">
                Paypal information
              </div>
			    
              <div class="form-item form-type-container form-name-card-container paypal-option-info payment-option-info elhide">
                Quick, easy and safe payment with your PayPal account.
              </div>
			  
			    <div id="billing_email" class="form-group">
                <label for="name">{{ trans('booking/pay.billingEmail') }}:</label>
                <input value="{{ $booking->email }}" name="billing_email" type="text" class="form-control input"
                    placeholder="{{ trans('booking/pay.billingEmail') }}"><br>
            </div>
              <div class="card-label sepa_debit-option-title payment-option-info elhide">
                SEBA DIRECT DEBIT information
              </div>
              <div class="form-item form-type-container form-name-card-container sepa_debit-option-info payment-option-info elhide">
       
                <fieldset>
                  <label>
                      <span>IBAN</span>
                      <div id="iban-element" class="field"></div>
                  </label>
                </fieldset>
                <div class="errmsg elhide"></div>
                By providing your IBAN and confirming this payment, you’re authorizing Payments Demo and Stripe, our payment provider, to
                send instructions to your bank to debit your account. You’re entitled to a refund under the terms and conditions
                of your agreement with your bank.
              </div>
              <div class="card-label bancontact-option-title payment-option-info elhide">
                BANCONTACT information
              </div>
              <div class="form-item form-type-container form-name-card-container bancontact-option-info payment-option-info elhide">
                You’ll be redirected to the banking site to complete your payment.
              </div>
              <div class="card-label giropay-option-title payment-option-info elhide">
                GIROPAY information
              </div>
              <div class="form-item form-type-container form-name-card-container giropay-option-info payment-option-info elhide">
                You’ll be redirected to the banking site to complete your payment.
              </div>
              <div class="card-label sofort-option-title payment-option-info elhide">
                SOFORT information
              </div>
              <div class="form-item form-type-container form-name-card-container sofort-option-info payment-option-info elhide">
                You’ll be redirected to the banking site to complete your payment.
              </div>
              <div class="card-label ideal-option-title payment-option-info elhide">
                IDEAL information
              </div>
              <div class="form-item form-type-container form-name-card-container ideal-option-info payment-option-info elhide">
                  <fieldset>
                      <label>
                          <span>iDEAL Bank</span>
                          <div id="ideal-bank-element" class="field"></div>
                      </label>
                  </fieldset>
                <br>
                Select Bank and You’ll be redirected to the banking site to complete your payment.
              </div>
				<input type="hidden" name="shipping_country" class="form-hidden" value="{{$booking->bookingcountry}}">
				<input type="hidden" name="ordervalue" class="form-hidden" value="{{ $totalPrice*100 }}">
                  <input type="hidden" name="stripe_source" class="form-hidden" value=""> </div>
				  <input type="hidden" name="paymentintent" value="{{ $intent }}"/>
            <input type="hidden" name="form_order_checkout" value="1">
            <input type="hidden" name="form_token" value="6ace0c7e2425a73eb9e02cce12474863">
   <div class="checkout-errormsg" id="checkout-errormsg">

              </div>
            {{--<div class="form-group">
                        <h3>{{ trans('booking/pay.confirmationTo') }}:</h3>
            <label class="checkbox-inline">
                <input type="checkbox"> {{ trans('booking/pay.epost') }}
            </label>
            <label class="checkbox-inline">
                <input type="checkbox"> {{ trans('booking/pay.sms') }}
            </label>
        </div>
        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox"> {{ trans('booking/pay.moreInfo') }}
            </label>
        </div>--}}
        {{--<p>
                        {!! Form::open(array('url' => 'booking/confirmation', 'method' => 'get')) !!}
                        {!! Form::submit(trans('booking/pay.doPayment'), array('class' => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
                    </p>--}}


        {{--{!! Form::submit(trans('booking/confirm.confirmSend'), ['ng-click' => 'submitStripe($event)', 'ng-value' => 'submitStripeButtonText', 'ng-disabled' => 'disableStripeButton', 'class' => 'shopButton']) !!}--}}

        {!! Form::button(trans('booking/confirm.confirmSend'), ['class' => 'btn btn-warning', 'id' => 'proceedBtn','onclick' => 'proceedPayment()' ,'name' => 'proceedbtn' ,'data-secret' => $client_secret]) !!}

        {!! Form::close() !!}
    </div>
</div>
<div class="row">
    <div class="col-sm-12 contentBoxHolder">
        {!! $klarnaSnippet !!}
    </div>
</div>
  <form id = "paypal_checkout" action = "https://www.sandbox.paypal.com/cgi-bin/webscr" method = "post" style="display:none">
<input name="cmd" value="_cart" type="hidden">
    <input name = "upload" value = "1" type = "hidden">
    <input name = "no_note" value = "0" type = "hidden">
    <input name = "bn" value = "PP-BuyNowBF" type = "hidden">
    <input name = "tax" value = "0" type = "hidden">
    <input name = "rm" value = "2" type = "hidden">
    <input name="address_override" value="1" type="hidden">
    <input name = "address1" type="hidden" value="{{$booking->address}}">
    <input name = "address2" type="hidden">
    <input name = "email" type="hidden" value="{{$booking->address}}">
    <input name = "first_name" type="hidden" value="{{$booking->name}}">
    <input name = "last_name" type="hidden" >
    <input name = "zip" type="hidden" value="{{$booking->post_code}}">
    <input name = "city" type="hidden" value="{{$booking->city}}">
    <input name = "lc" value = "US" type = "hidden">
    <input name = "country" type="hidden">

    <input name = "business" value = "{{$centrePaypalemail}}" type = "hidden">
    <input name = "handling_cart" value = "0" type = "hidden">
    <input name = "currency_code" value = "EUR" type = "hidden">
    <input name = "return" value = "{{url('/booking/confirmation')}}" type = "hidden">
    <input name = "cbt" value = "Return to My Site" type = "hidden">
    <input name = "cancel_return" value = "{{url('/booking/confirm')}}?bookingId={{$booking->id}}" type = "hidden">
    <input name = "custom" value = "" type = "hidden">
 
    <div id = "item_1" class = "itemwrap">
        <input name = "item_name_1" value = "BOOKING {{$booking->id}}" type = "hidden">
        <input name = "quantity_1" value = "1" type = "hidden">
        <input name = "amount_1" value = "{{ $totalPrice }}" type = "hidden">
        <input name = "shipping_1" value = "0" type = "hidden">
    </div>
 
    
</form>
@include('booking.partials.stripe')

@endsection

@section('meta')
<meta name="publishable-key" content="{{ $centreStripePublicKey }}">
@endsection

@section('footerFirst')
<script src="/js/StripeBilling.js"></script>
<script src="{{ asset('/js/font_awesome.js') }}"></script>

<!--script type="text/javascript" src="https://js.stripe.com/v2/"></script-->
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/payments.js')}}"></script>

@endsection

@section('footer')

<script>


    $(document).ready(function(){
		changeShippingTo("{{$booking->bookingcountry}}");
			$('#billing_name').hide();
            $('.addressDetails').hide();
            $("#billing_email").hide();
        });


</script>
@endsection