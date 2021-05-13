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
    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div id="paymentBox" class="contentBox">
                {{--@include("partials.bookingBreadcrumbs")--}}

                <h3>{{ trans('booking/cancel.heading') }}</h3>
                @if(sizeof($bookingProducts) > 0)
                    <p>Booking number: {{ $bookingProducts[0]->booking_id }}</p>
                    <p>Booking status:
                        @if($bookingProducts[0]->status == 1)
                            <span style="color:green">new</span>
                        @elseif($bookingProducts[0]->status == 2)
                            <span style="color:green">paid</span>
                        @elseif($bookingProducts[0]->status == 3)
                            <span style="color:green">activated</span>
                        @elseif($bookingProducts[0]->status == 4)
                            <span style="color:red">cancelled</span>
                        @elseif($bookingProducts[0]->status == 5)
                            <span style="color:red">credited</span>
                        @endif</p>
                @endif

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
                        <th>{{ trans('booking/cancel.removeProduct') }}</th>
                    @foreach($bookingProducts as $bookingProduct)
                        <tr>
                            <td>{{ $bookingProduct->productName }}</td>
                            <td>{{ $bookingProduct->startDateTime }}</td>
                            <td>{{ $bookingProduct->endDateTime }}</td>
                            <td>{{ $bookingProduct->price }}</td>
                            <td>
                                @if($bookingProduct->klarna_product_status < 3)
                                    {!! Form::open(array('url' => '/booking/removeProduct', "class" => "form-inline")) !!}
                                    <input type="hidden" name="bookingProductId" value="{{  $bookingProduct->bpId }}"/>
                                    <input type="hidden" name="returnUrl" value="{{  "$_SERVER[REQUEST_URI]" }}"/>
                                    <input type="submit" value="{{ trans('booking/cancel.removeProductButton') }}"/>
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </table>


                    @if(sizeof($bookingProducts) > 0)
                        @if($bookingProducts[0]->status == 1 or $bookingProducts[0]->status == 2 or $bookingProducts[0]->status == 3)
                            {!! Form::open(array('url' => '/booking/cancelBooking', "class" => "form-inline")) !!}
                                <input type="hidden" name="bookingId" value="{{  $bookingProduct->booking_id }}"/>
                                <input type="hidden" name="main_klarna_invoiceId" value="{{  $bookingProduct->main_klarna_invoiceId }}"/>
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
