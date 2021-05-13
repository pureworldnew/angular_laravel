@extends('app')

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        }
        #paymentBox input[type=text], #paymentBox select {
            width: 25%;
            margin-top: 10px;
        }
        .paymentMethods li {
            list-style: none;
        }
        #klarna-checkout-container {
            display:none;
        }
        #billing-form span.error {
            display:none;
            color:red;
        }
    </style>
    <div class="row">
        <div class="col-xs-12 {{--col-sm6-4 col-md-4 --}}contentBoxHolder">
            <div id="paymentBox" class="contentBox">
                @include("partials.bookingBreadcrumbs")

                {!! Form::open(array('url' => '/booking/confirmation', "id" => "billing-form")) !!}

                    <div class="form-group">
                        <h3>{{ trans('booking/pay.customerType') }}</h3>
                        <input id="customerTypeIndividual" type="radio" name="customerType" value="2" checked> {{ trans('booking/pay.customerTypeIndividual') }}
                        <input id="customerTypeCompany" type="radio" name="customerType" value="1" > {{ trans('booking/pay.customerTypeCompany') }}

                    </div>

                    <h3>{{ trans('booking/pay.paymentMethodHeading') }}</h3>
                    <ul class="paymentMethods">
                        @foreach($paymentMethods as $method)
                            <li><label class="radio-inline">{{ Form::radio('paymentMethod', $method->shortName, false, array('class' => 'paymentMethod', 'id' => 'paymentMethod'.$method->shortName)) }} {{ trans('booking/pay.payment'.$method->shortName) }}</label></li>
                            @if($method->shortName == 'Transfer')
                               <p id="paymentTransferHow" class="paymentHow" style="display:none">{{ $paymentTransferHow }}</p>
                            @elseif($method->shortName == 'Cash')
                                <p id="paymentCashHow" class="paymentHow" style="display:none">{{ $paymentCashHow }}</p>
                            @elseif($method->shortName == 'Invoice')
                                <p id="paymentInvoiceHow" class="paymentHow" style="display:none">{{ $paymentInvoiceHow }}</p>
                            @endif
                        @endforeach
                    </ul>

                    <h3>{{ trans('booking/pay.customerDetails') }}: </h3>
                    <div class="form-group">
                        <label for="name">{{ trans('booking/pay.name') }}:</label>
                        <input value="{{ $booking->name }}" name="name" type="text" class="form-control input" placeholder="{{ trans('booking/pay.name') }}"><br>
                    </div>

                    <div class="form-group addressDetails">
                        <label for="exampleInputEmail1">{{ trans('booking/pay.address') }}:</label><BR>
                        <input name="address" value="{{ $booking->address }}" type="text" class="form-control input" placeholder="{{ trans('booking/pay.yourAddress') }}"><BR>
                        <input name="post_code" value="{{ $booking->post_code }}" type="text" class="form-control input" placeholder="{{ trans('booking/pay.postcode') }}"><BR>
                        {{ Form::select('country', array('1' => trans('booking/pay.sweden'), '2' => trans('booking/pay.germany')), null, array('class' => 'form-control input')) }}<br>
                    </div>

                    @include("booking.partials.stripe")



                    {{--<div class="form-group">
                        <h3>{{ trans('booking/pay.confirmationTo') }}:</h3>
                        <label class="checkbox-inline">
                            <input type="checkbox" > {{ trans('booking/pay.epost') }}
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" > {{ trans('booking/pay.sms') }}
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox" > {{ trans('booking/pay.moreInfo') }}
                        </label>
                    </div>--}}
                    {{--<p>
                        {!! Form::open(array('url' => 'booking/confirmation', 'method' => 'get')) !!}
                        {!! Form::submit(trans('booking/pay.doPayment'), array('class' => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
                    </p>--}}


                    {{--{!! Form::submit(trans('booking/confirm.confirmSend'), ['ng-click' => 'submitStripe($event)', 'ng-value' => 'submitStripeButtonText', 'ng-disabled' => 'disableStripeButton', 'class' => 'shopButton']) !!}--}}

                    {!! Form::submit(trans('booking/confirm.confirmSend'), ['class' => 'btn btn-warning', 'id' => 'submitPay']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            {!! $klarnaSnippet !!}
        </div>
    </div>

    @include('booking.partials.stripe')

@endsection

@section('meta')
    <meta name="publishable-key" content="{{ $centreStripePublicKey }}">
@endsection

@section('footerFirst')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="/js/StripeBilling.js"></script>
@endsection

@section('footer')

    <script>
        $(document).ready(function(){
            var klarnaPayment = false;
            var stripePayment = false;
            //$("#submitPay").hide();
            $('#paymentMethodTransfer').click(function(){
                $('.paymentHow').hide();
                $('#paymentTransferHow').toggle();
            });
            $('#paymentMethodCash').click(function(){
                $('.paymentHow').hide();
                $('#paymentCashHow').toggle();
            });
            $('#paymentMethodInvoice').click(function(){
                $('.paymentHow').hide();
                $('#paymentInvoiceHow').toggle();
            });

            function noKlarnaPayment()
            {
                $('.paymentMethod').each(function() {
                    if($(this).attr('value') == "Klarna")
                    {
                        $(this).prop( "disabled", true );
                        $(this).prop( "checked", false );
                    }
                    else
                    {
                        $(this).prop( "disabled", false );
                    }
                });
                $("#klarna-checkout-container").hide();
                $('.paymentMethod:first').prop( "checked", true );
                $("#submitPay").show();
            }

            function onlyKlarnaPayment()
            {
                var hasKlarna = false;

                $('.paymentMethod').each(function() {


                    if($(this).attr('value') != "Klarna")
                    {
                        $(this).prop( "disabled", true );
                        $(this).prop( "checked", false );
                    }
                    else {
                        $(this).prop( "disabled", false );
                        $(this).prop( "checked", true );
                        hasKlarna = true;
                    }


                });
                if(!hasKlarna)
                {
                    $('.paymentMethod').each(function() {
                        $(this).prop( "disabled", false );
                    });
                }

                $("#klarna-checkout-container").show();
                $("#submitPay").hide();
            }

            onlyKlarnaPayment();


            $("#customerTypeCompany").click(function(){
                noKlarnaPayment();
                $('.addressDetails').show();
                $("#submitPay").show();
            });

            $("#customerTypeIndividual").click(function(){
                onlyKlarnaPayment();
                $('.addressDetails').hide();
                $("#submitPay").hide();
            });

            $(".paymentMethods input").click(function(evt){

                stripePayment = false;
                klarnaPayment = false;
                if($(evt.target).attr('value') == "Card" || $(evt.target).attr('value') == "Stripe")
                {
                    stripePayment = true;
                    $("#klarna-checkout-container").hide();
                    $("#stripePaymentDetails").show();
                    $("#submitPay").click(function(evt){

                        if($('#paymentMethodStripe').is(':checked') === true)
                        {
                            evt.preventDefault();

                            StripeBilling.init($('#billing-form'));
                            StripeBilling.sendToken(evt);
                        }
                    });
                }
                else if($(evt.target).attr('value') == "Klarna")
                {
                    klarnaPayment = true;
                    $("#stripePaymentDetails").hide();

                    if($("#cancellationTerms").is(":checked"))
                    {
                        $("#klarna-checkout-container").show();
                    }
                    $("#submitPay").hide();
                }
                else {
                    $("#stripePaymentDetails").hide();
                    $("#klarna-checkout-container").hide();
                    $("#submitPay").show(600);
                }
            });

            /*$("#cancellationTerms").click(function(evt){

                if($(evt.target).is(':checked') && klarnaPayment)
                {
                    $("#klarna-checkout-container").show();
                }

            });*/
        });


    </script>
@endsection