<h4 v-show="afterInitialLoad" class="afterInitialLoad" style="display:none">{{ trans('booking/index.totalPrice') }}:</h4>
<h2 v-show="afterInitialLoad" class="afterInitialLoad" style="display:none">@{{ totalPrice }} kr</h2>
<h4 v-show="afterInitialLoad" class="afterInitialLoad" style="display:none">{{ trans('booking/index.totalReservationPrice') }}:</h4>
<h2 v-show="afterInitialLoad" class="afterInitialLoad" style="display:none">@{{ totalReserve }} kr</h2>

@if(sizeof($klarnaDetails->payment_methods) > 0)
    <div style="width:210px; height:80px"
         class="klarnaPaymentMethodWidget klarna-widget klarna-part-payment"
         data-eid={{$klarnaDetails->getKlarnaApiKey()}},
         data-locale="{{$klarnaDetails->getCountryLanguageCode()}}"
         data-price="@{{ totalPrice }}"
         data-layout="pale-v2"
         data-invoice-fee="0">
    </div>
@endif
<br/>
<br/>
@if(isset($booking->id))
    <div style="display:none" v-show="shoppingCart.length > 0">
        {!! Form::open(array('url' => '/booking/empty-cart', 'method' => 'post', 'class' => 'emptyCartLink')) !!}
        {!! Form::hidden('bookingId', $booking->id) !!}
        {!! Form::submit(trans('booking/index.cartEmpty'), array('class' => 'btn btn-warning')) !!}
        {!! Form::close() !!}
    </div>
@endif