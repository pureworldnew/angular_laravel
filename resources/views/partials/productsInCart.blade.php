<style>
    .shoppingCartTable
    {
        width:100%;
    }
    h3.shoppingCartProductHeading {
        margin-top: 6px;
    }
</style>
@foreach($booking->products as $product )
    <tr>
        <td>
            {{-- {{ $product->name }}, {{ $product->quantity }}, st {{ $product->startDateTime }}, --}}{{--3   item.duration }}--}}{{-- kostnad {{ $product->pivot->price }} SEK<br/>
             <b>Date:</b> {{ $product->pivot->startDateTime }}
             --}}
            @if (!isset($confirmPage))
                <img style="float: left;margin-right: 12px;width: 100px;" v-if="item.image" src="/images/products/{{$product->image}}"/>
            @endif
            <h3 class="shoppingCartProductHeading">{{ $product->name }} ({{ round($product->pivot->quantity) }} {{ trans('booking/index.pieces') }})</h3>
            <table class="shoppingCartTable">
                <tr><td class="firstCol">{{ trans('booking/index.cartCategory') }}:</td><td>{{ $product->category->name }}</td></tr>
                <tr><td class="firstCol">{{ trans('booking/index.cartQuantity') }}:</td><td>{{ round($product->pivot->quantity) }} {{ trans('booking/index.pieces') }}</td></tr>
                @if(!$product->isFee())
                    <tr><td class="firstCol">{{ trans('booking/index.cartDate') }}:</td><td>{{ substr($product->pivot->startDateTime, 0, 10) }}</td></tr>
                    <tr><td class="firstCol">{{ trans('booking/index.cartStartTime') }}:</td><td>{{ substr($product->pivot->startDateTime, 10, 6) }}</td></tr>
                @endif
                {{--<tr>
                    <td>Duration:</td>
                    <td>
                    <span v-show="(item.productTimeType == 'perDay')">
                        @{{ item.durationDays }} {{ trans('booking/index.days') }}
                    </span>
                    <span v-show="(item.productTimeType == 'perHour')">
                        @{{ item.durationHours }} {{ trans('booking/index.hours') }}
                    </span>
                    </td>
                </tr>--}}
                <tr>
                    <td class="firstCol">Price:</td>
                    <td>{{ $product->pivot->price }} {{ trans('booking/index.currency') }}</td>
                </tr>
            </table>


        </td>
        <td><br/><br/><br/>
            {!! Form::open(array($removeProductEvent => 'removeCartItem('.$product->pivot->id.')')) !!}

                {!! Form::hidden('bookingId', $product->pivot->booking_id) !!}
                {!! Form::submit(trans('booking/index.delete'), array('class' => 'btn btn-warning')) !!}
            {!! Form::close() !!}</td>


    </tr>
@endforeach