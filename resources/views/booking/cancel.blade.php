@extends('app')
@section('meta')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <style>
        [class^="icon-"], [class*=" icon-"] {
            display: inline-block;
            width: 14px;
            height: 14px;
            line-height: 14px;
            vertical-align: text-top;
            background-image: url(/css/img/glyphicons-halflings.png);
            background-position: 14px 14px;
            background-repeat: no-repeat;
            margin-top: 1px;
        }
        .icon-ok {
            background-position: -288px 0;
        }
        .icon-white {
            background-image: url(/css/img/glyphicons-halflings-white.png);
        }
        .icon-remove {
            background-position: -312px 0;
        }
    </style>
@endsection
@section('footer')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="/js/editBooking.js"></script>
@endsection
@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        }

    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div id="paymentBox" class="contentBox">
                {{--@include("partials.bookingBreadcrumbs")--}}
                <div class="row">
                    <div class="col-sm-12 contentBoxHolder">
                        <h3>{{ trans('booking/cancel.heading') }}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 contentBoxHolder">
                        @if(sizeof($booking->products) > 0)
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>Booking number:</p>
                                    <p>Booking status:</p>
                                    <p>Total price:</p>
                                </div>
                                <div class="col-sm-6">
                                    <p>{{ $booking->id }}</p>
                                    <p> @if($booking->isNew())
                                            <span style="color:green">new</span>
                                        @elseif($booking->isPaid())
                                            <span style="color:green">paid</span>
                                        @elseif($booking->isActivated())
                                            <span style="color:green">activated</span>
                                        @elseif($booking->isCancelled())
                                            <span style="color:red">cancelled</span>
                                        @elseif($booking->isCredited())
                                            <span style="color:red">credited</span>
                                        @endif</p>
                                    <p><span id="totalPrice">{{ $booking->totalPrice() }}</span> kr</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-8 contentBoxHolder">

                    </div>
                </div>

                @if(Session::has('flashMessage'))
                    <p style="color:blue;font-weight: 1.3em;">{{ Session::get('flashMessage') }}</p>
                @endif

                @if($error)
                    {!! $errorMessage !!}
                @else
                    <table class="table">
                        <th>{{ trans('booking/cancel.productName') }}</th>
                        <th>{{ trans('booking/cancel.startDateTime') }}</th>
                        <th>{{ trans('booking/cancel.endDateTime') }}</th>
                        <th>{{ trans('booking/cancel.price') }}</th>
                        <th>{{ trans('booking/cancel.quantity') }}</th>
                        <th>{{ trans('booking/cancel.removeProduct') }}</th>
                    @foreach($booking->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ !$booking->productIsFee($product->pivot->id) ? $product->pivot->startDateTime : "" }}</td>
                            <td>{{ !$booking->productIsFee($product->pivot->id) ? $product->pivot->endDateTime : "" }}</td>
                            <td><span class="productPrice">{{ $product->pivot->price }}</span> kr</td>
                            @if(!$booking->productRemoved($product->pivot->id) and $booking->productCanBeRemoved($product->pivot->id))
                                <td><a href="" class="quantity" data-type="text" data-pk="{{ $product->pivot->id }}" data-url="/api/booking/updateProductQuantity" data-title="Enter quantity" data-value="{{ round($product->pivot->quantity) }}">{{ round($product->pivot->quantity) }}</a></td>
                            @else
                                <td>{{ round($product->pivot->quantity) }}</td>
                            @endif

                            <td>
                                @if(!$booking->productRemoved($product->pivot->id))
                                    {{---{{$booking->productInTimeToCancel($product->id)}}-{{$booking->productCanBeRemoved($product->id)}}---}}
                                    @if(((Auth::check() AND $booking->userHasAccess(Auth::user()->id)) || $booking->productInTimeToCancel($product->pivot->id)) AND $booking->productCanBeRemoved($product->pivot->id))

                                        {!! Form::open(array('url' => '/booking/removeProduct', "class" => "form-inline")) !!}
                                            <input type="hidden" name="bookingProductId" value="{{  $product->pivot->id }}"/>
                                            <input type="hidden" name="returnUrl" value="{{  "$_SERVER[REQUEST_URI]" }}"/>
                                            <input type="submit" value="{{ trans('booking/cancel.removeProductButton') }}"/>
                                        {!! Form::close() !!}

                                    @endif
                                @else
                                    {{ trans('booking/cancel.removed') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if ($booking->bookingFee <> 0)
                        <tr>
                            <td><b>{{ trans('admin/bookings.bookingFee') }}:</b></td>
                            <td></td>
                            <td></td>
                            <td><span class="productPrice">{{  $booking->bookingFee }}</span> kr</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                    </table>


                    @if(sizeof($booking->products) > 0)
                       @if(($booking->isNew() or $booking->isPaid() or $booking->isActivated()) AND ((Auth::check() AND $booking->userHasAccess(Auth::user()->id)) || $booking->allProductsInTimeToCancel()))
                            {!! Form::open(array('url' => '/booking/cancelBooking', "class" => "form-inline")) !!}
                                <input type="hidden" name="bookingId" value="{{  $booking->id }}"/>
                                <input type="hidden" name="main_klarna_invoiceId" value="{{  $booking->getInvoiceId() }}"/>
                                <input type="hidden" name="returnUrl" value="{{  "$_SERVER[REQUEST_URI]" }}"/>
                                <input type="submit" value="{{ trans('booking/cancel.cancelBookingHeading') }}"/>
                            {!! Form::close() !!}
                        @endif
                    @endif
                @endif


            </div>
        </div>
    </div>

@endsection
