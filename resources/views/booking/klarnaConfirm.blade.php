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
    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div id="paymentBox" class="contentBox">
                @include("partials.bookingBreadcrumbs")
                {!! $klarnaSnippet !!}
                <p>
                    {!! Form::open(array('url' => 'booking/confirmation', 'method' => 'get')) !!}
                    {!! Form::submit(trans('booking/pay.doPayment'), array('class' => 'btn btn-danger')) !!}
                    {!! Form::close() !!}
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            {!! $klarnaSnippet !!}
        </div>
    </div>
@endsection

@section('footer')
    <script>

        $(".paymentMethods input").click(function(evt){
            if($(evt.target).attr('value') == "Card")
            {
                $("#klarna-checkout-container").show();
            }
        });
    </script>
@endsection