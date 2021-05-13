@extends('app')
@section('meta')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection
@section('footer')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/js/editBooking.js"></script>

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

@section('content')
<style>
    #confirmNavBox {
        margin-top: 200px;
    }
    .bookingDetail td
    {
        border-top: 0 !important;
    }

</style>
<div class="row">
    <div class="col-sm-12 contentBoxHolder">
        <div class="contentBox">
            {{--@include("admin.adminNav")--}}
            <br/>
            <a href="/admin/bookings">< back</a>
            <br/>
            <h1>{{ trans('admin/bookings.booking') }} #{{ $booking->id }}</h1>
            <div class="row">
                <div class="col-sm-6 contentBoxHolder">
                    <div class="contentBox">
                        <table class="bookingDetail table">
                           {{-- <tr>
                                <td class="detailLabel"><b>{{ trans('admin/bookings.categoryName') }}:</b></td>
                                <td>{{ $bookingProducts[0]->categoryName }}</td>
                            </tr>
                            <tr>
                                <td><b>{{ trans('admin/bookings.productName') }}:</b></td>
                                <td>{{ $bookingProducts[0]->productName }}</td>
                            </tr>--}}
                            <tr>
                                <td><b>{{ trans('admin/bookings.price') }}:</b></td>
                                <td><span id="totalPrice">{{ $booking->totalPrice() }}</span> kr</td>
                            </tr>
                            <tr>
                                <td><b>{{ trans('admin/bookings.reserveprice') }}:</b></td>
                                <td><span id="totalPrice">{{ $booking->totalReservePrice() }}</span> kr</td>
                            </tr>
                            <tr>
                                <td><b>{{ trans('admin/bookings.restprice') }}:</b></td>
                                <td><span id="totalPrice">{{ $booking->resetReservePrice() }}</span> kr</td>
                            </tr>
                            @if ($booking->bookingFee <> 0)
                                <tr>
                                    <td><b>{{ trans('admin/bookings.bookingFee') }}:</b></td>
                                    <td>{{ round($booking->bookingFee) }} kr</td>
                                </tr>
                            @endif
                            <tr>
                                <td><b>{{ trans('admin/bookings.bookingTableOrderStatus') }}:</b></td>
                                <td>
                                    @if ($booking->status == 1)
                                        <span style='font-weight:bold;color:blue;'>
                                    @endif
                                    {{ trans('admin/bookings.bookingStatus'.$booking->getBookingStatus()) }}
                                    @if ($booking->status == 1)
                                        </span>
                                    @endif

                                </td>
                            </tr>
                            @if ($booking->klarna_orderId <> "")
                                <tr>
                                    <td><b>{{ trans('admin/bookings.klarnaOrderId') }}:</b></td>
                                    <td>{{ $booking->klarna_orderId }}</td>
                                </tr>
                            @endif
                            @if ($booking->klarna_reservationId <> "")
                                <tr>
                                    <td><b>{{ trans('admin/bookings.klarnaReservationNumber') }}:</b></td>
                                    <td>{{ $booking->klarna_reservationId }}</td>
                                </tr>
                            @endif
                            @if ($booking->getInvoiceId() <> "")
                                <tr>
                                    <td><b>{{ trans('admin/bookings.klarnaInvoiceNumber') }}:</b></td>
                                    <td>{{ $booking->getInvoiceId() }}</td>
                                </tr>
                            @endif
                            @if ($booking->payment_method <> "")
                                <tr>
                                    <td><b>{{ trans('admin/bookings.paymentMethod') }}:</b></td>
                                    <td>{{ trans('admin/bookings.paymentMethod'.$booking->payment_method) }}</td>
                                </tr>
                            @endif

                            @if ($booking->manualRefundRequired())
                                <tr>
                                    <td><span style="color:red"><b>{{ trans('admin/bookings.manualRefundRequired') }}</b></span></td>
                                    <td></td>
                                </tr>
                            @endif

                            @if ($booking->freeText <> "")
                                <tr>
                                    <td><b>{{ trans('admin/bookings.freeText') }}</b></td>
                                    <td>{{$booking->freeText}}</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                </div>
                <div class="col-sm-6 contentBoxHolder">
                    <div class="contentBox">
                        <table class="bookingDetail table">
                            <tr>
                                <td><b>{{ trans('admin/bookings.name') }}:</b></td>
                                <td>{{ $booking->name }}</td>
                            </tr>

                            <tr>
                                <td><b>{{ trans('admin/bookings.address') }}:</b></td>
                                <td>{{ $booking->address }}</td>
                            </tr>

                            @if($booking->address2 <> "")
                                <tr>
                                    <td></td>
                                    <td>{{ $booking->address2 }}</td>
                                </tr>
                            @endif

                            <tr>
                                <td><b>{{ trans('admin/bookings.city') }}:</b></td>
                                <td>{{ $booking->city }}</td>
                            </tr>

                            <tr>
                                <td><b>{{ trans('admin/bookings.post_code') }}:</b></td>
                                <td>{{ $booking->post_code }}</td>
                            </tr>

                            {{--<tr>
                                <td><b>{{ trans('admin/bookings.country') }}:</b></td>
                                <td>{{ $booking->country }}</td>
                            </tr>--}}

                            <tr>
                                <td><b>{{ trans('admin/bookings.telephone') }}:</b></td>
                                <td>{{ $booking->telephone }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>




            <br/><br/><br/>
            @if(Session::has('flashMessage'))
                <p style="color:blue;font-weight: 1.3em;">{{ Session::get('flashMessage') }}</p>
            @endif
            @if(Session::has('flashMessageError'))
                <p style="color:red;font-weight: 1.3em;">{{ Session::get('flashMessageError') }}</p>
            @endif

            @if(sizeof($booking->products) > 0)
                <table class="table">
                    <tr>
                        <th>{{ trans('admin/bookings.productName') }}</th>
                        <th>{{ trans('admin/bookings.productNumber') }}</th>
                        <th>{{ trans('admin/bookings.categoryName') }}</th>
                        <th>{{ trans('admin/bookings.startDateTime') }}</th>
                        <th>{{ trans('admin/bookings.endDateTime') }}</th>
                        <th>{{ trans('admin/bookings.price') }}</th>
                        <th>{{ trans('admin/bookings.reserveprice') }}</th>
                        <th>{{ trans('admin/bookings.restprice') }}</th>
                        <th>{{ trans('admin/bookings.quantity') }}</th>
                        <th>{{ trans('admin/bookings.activation') }}</th>
                        <th>{{ trans('admin/bookings.registerPayment') }}</th>
                        <th>{{trans('booking/index.number_of_persons')}}</th>
                        <th>{{ trans('admin/bookings.invoiceNumber') }}</th>
                        <th>{{ trans('admin/bookings.cancelProduct') }}</th>

                        {{--<th>{{ trans('admin/bookings.activateSelectedProducts') }}</th>
                        <th>{{ trans('admin/bookings.refundSelectedProducts') }}</th>--}}
                    </tr>

    <?php
                    $selectActivation = false;
                    $selectCancelation = false;
                    //die(var_dump($product);
    ?>

                    @foreach ($booking->products as $product)
                   <!-- -->

                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ ($product->pivot->startDateTime <> "2000-01-01 00:00:00") ? $product->pivot->startDateTime : "" }}</td>
                        <td>{{ ($product->pivot->endDateTime <> "2000-01-01 00:00:00") ? $product->pivot->endDateTime : "" }}</td>
                        <td><span class="productPrice">{{ $product->pivot->price }}</span> kr</td>
                        <td><span class="productPrice">{{ $product->pivot->reserve_price }}</span> kr</td>
                        <td><span class="productPrice">{{ $product->pivot->reserve_rest_price }}</span> kr</td>
                        @if(!$booking->productRemoved($product->pivot->id) and $booking->productCanBeRemoved($product->pivot->id))
                            <td><a href="" class="quantity" data-type="text" data-pk="{{ $product->pivot->id }}" data-url="/api/booking/updateProductQuantity" data-title="Enter quantity" data-value="{{ round($product->pivot->quantity) }}">{{ round($product->pivot->quantity) }}</a></td>
                        @else
                            <td>{{ round($product->pivot->quantity) }}</td>
                        @endif
                        <td>
                            @if ($booking->isNew() AND $product->isNew() AND !$booking->productRemoved($product->pivot->id))
                                @if (($booking->paymentMethodIsKlarna() AND ($booking->getProductInvoiceId($product->pivot->id) == ""))
                                    or ($booking->paymentMethodIsCash() or $booking->paymentMethodIsTransfer() or $booking->paymentMethodIsInvoice()))

                                        {!! Form::open(['url' => '/admin/booking/activateProduct', 'method' => 'post', 'files' => false, 'class' => 'form-horizontal']) !!}
                                            <input type="hidden" name="reservationId" value="{{ $booking->klarna_reservationId }}"/>
                                            <input type="hidden" name="productId" value="{{ $booking->getProductIdentifier($product->pivot->id) }}"/>
                                            <input type="hidden" name="price" value="{{ $product->pivot->price }}"/>
                                            <input type="hidden" name="bookingProductId" value="{{ $product->pivot->id }}"/>
                                            <input type="hidden" name="product_number" value="xxx"/>
                                            <input type="hidden" name="bookingId" value="{{ $booking->id }}"/>
                                            <input type="hidden" name="quantity" value="{{ $product->pivot->quantity }}"/>
                                            <input type="submit" value="{{ trans('admin/bookings.activateproduct') }}"/>
                                        {!! Form::close() !!}

                                @endif
                            @elseif($product->isActivated())
                                {{ trans('admin/bookings.productActivated') }}
                            @elseif($product->isCancelled())
                                {{ trans('admin/bookings.productCancelled') }}
                            @elseif($product->isCredited())
                                {{ trans('admin/bookings.productCredited') }}
                            @endif
                        </td>

                        <td><!-- register -->
                            @if (($booking->paymentMethodIsCash() or $booking->paymentMethodIsTransfer() or $booking->paymentMethodIsInvoice())
                                    AND ($booking->isActivated() and $booking->productIsActivated($product->pivot->id) ))
                                {!! Form::open(['url' => '/admin/booking/registerPayment', 'method' => 'post', 'files' => false, 'class' => 'form-horizontal']) !!}
                                <input type="hidden" name="bookingId" value="{{ $booking->id }}"/>
                                <input type="hidden" name="productId" value="{{ $booking->product}}"/>
                                <input type="submit" value="{{ trans('admin/bookings.registerPayment') }}"/>
                                {!! Form::close() !!}
                            @endif
                        </td>
                        <td>{{ $product->pivot->persons }}</td>
                        <td>{{ $booking->getProductInvoiceId($product->pivot->id) }}</td>
                     
                        <td>
                            @if(!$booking->productRemoved($product->pivot->id))
                                @if($product->isCancelled())
                                    {{ trans('admin/bookings.bookingStatusCancelled') }}
                                @elseif ($product->isCredited())
                                    {{ trans('admin/bookings.productCredited') }}
                                @elseif ($product->isCancelled())
                                    {{ trans('admin/bookings.productCredited') }}
                                @elseif ($booking->productCanBeRemoved($product->pivot->id))
                                    {!! Form::open(['url' => '/booking/removeProduct', 'method' => 'post', 'files' => false, 'class' => 'form-horizontal']) !!}

                                    <input type="hidden" name="bookingProductId" value="{{  $product->pivot->id }}"/>
                                    <input type="hidden" name="returnUrl" value="{{  "$_SERVER[REQUEST_URI]" }}"/>
                                        @if ($booking->productCanBeCancelled($product->pivot->id))
                                            <input type="submit" value="{{trans('admin/bookings.cancelProduct') }}"/>
                                        @elseif($booking->productCanBeCredited($product->pivot->id))
                                            <input type="submit" value="{{trans('admin/bookings.refundProduct') }}"/>
                                        @endif
                                    {!! Form::close() !!}
                                @endif
                            @elseif($booking->getProductInvoice($product->pivot->id) AND $booking->getProductInvoice($product->pivot->id)->discounted)
                                {{ trans('admin/bookings.partiallyRefunded') }}
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
                            <td></td>
                            <td></td>
                            <td>{{  $booking->bookingFee  }} kr</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                </table>

                @if (/*$product->isNew() AND*/ ($booking->isNew()  or $booking->isPaid()))
                    <p>
                        {!! Form::open(array('url' => '/admin/booking/activate', "class" => "form-inline")) !!}
                        <input type="hidden" name="bookingId" value="{{  $booking->id }}"/>
                        <input type="submit" value="{{ trans('admin/bookings.bookingActivateBooking') }}"/>
                        {!! Form::close() !!}
                    </p>
                    <p>
                        {!! Form::open(array('url' => '/admin/booking/cancel', "class" => "form-inline")) !!}
                        <input type="hidden" name="bookingId" value="{{ $booking->id }}"/>
                        <input type="submit" value="{{ trans('admin/bookings.bookingCancelBooking') }}"/>
                        {!! Form::close() !!}
                    </p>
                @elseif ($booking->isActivated() AND $booking->paymentMethodIsKlarna())
                    <p>
                    {!! Form::open(array('url' => '/admin/booking/cancel', "class" => "form-inline")) !!}
                        <input type="hidden" name="invId" value="{{ $booking->getInvoiceId() }}"/>
                        <input type="hidden" name="bookingId" value="{{ $booking->id }}"/>
                        <input type="submit" value="{{ trans('admin/bookings.bookingCreditBooking') }}"/>
                    {!! Form::close() !!}
                    </p>
                @elseif ($booking->isActivated() AND $booking->paymentMethodIsStripe())
                    <p>
                        {!! Form::open(array('url' => '/admin/booking/cancel', "class" => "form-inline")) !!}
                        <input type="hidden" name="bookingId" value="{{ $booking->id }}"/>
                        <input type="submit" value="{{ trans('admin/bookings.bookingCreditBooking') }}"/>
                        {!! Form::close() !!}
                    </p>
                @endif

            @else

                <h4>{{ trans('admin/bookings.noProducts') }}</h4>
            @endif

        </div>
    </div>
</div>

@if(sizeof($invoicesArray) > 0 AND ($booking->isNew() or $booking->isPaid() or $booking->isActivated()))
<div class="row">
    <div class="col-sm-12 contentBoxHolder">
        <div class="contentBox">

            <h2>{{  trans('admin/bookings.currentInvoices')}}</h2>

                <table class="table">
                    <tr>
                        <th>{{  trans('admin/bookings.refundInvoices')}}</th>
                        <th>{{  trans('admin/bookings.invoiceAmount')}}</th>
                        <th>{{  trans('admin/bookings.invoiceStatus')}}</th>
                        <th>{{  trans('admin/bookings.refundDiscountedAmount')}}</th>
                        <th>{{  trans('admin/bookings.refundDiscountedReason')}}</th>
                    </tr>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->invoice_id }}</td>
                            <td>{{ number_format((float)$invoice->getInvoiceAmount(), 2, '.', '') }} {{ Config('booking.currencySymbol') }}</td>
                            <td>{{ trans('admin/bookings.invoiceStatus'.$invoice->statusText()) }}</td>
                            <td>{{ number_format((float)$invoice->discounted_amount, 2, '.', '') }} {{ Config('booking.currencySymbol') }}</td>
                            <td>{{ $invoice->discounted_reason }}</td>
                        </tr>
                    @endforeach
                </table>


        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 contentBoxHolder">
        <div class="contentBox">
            <h3>{{  trans('admin/bookings.refundAnInvoice')}}</h3>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::open(array('url' => '/admin/booking/returnAmount', "class" => "form-horizontal")) !!}
                <div class="form-group">
                    {!! Form::label('invoiceId', trans('admin/bookings.returnAmount')) !!}
                    {!! Form::select("invoiceId", $invoicesArray ) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('discountAmount', trans('admin/bookings.discountAmount')) !!}
                    {!! Form::text("discountAmount", null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('discountDescription', trans('admin/bookings.discountDescription')) !!}
                    {!! Form::text("discountDescription", null, ['class' => 'form-control']) !!}
                </div>

                <input type="hidden" name="bookingId" value="{{  $booking->id }}"/>

                <input type="submit" value="{{ trans('admin/bookings.refundAmount') }}"/>
            {!! Form::close() !!}
        </div>
    </div>

</div>
@endif
@endsection

@section('footer')
<script>
    $(window).ready(function() {
        $("#activateSelectedButton").click(function() {
            var selected = "";

            $('.activateSelected').each(function () {

                if($(this).is(':checked'))
                {
                    var prodId=$(this).attr("name").substring(16);
                    selected += prodId+",";
                }

            });
            selected = selected.replace(/,\s*$/, "");

            $("#selectedActivateProducts").val(selected);
        });

        $("#cancelSelectedButton").click(function(evt) {
            var selected = "";

            $('.cancelSelected').each(function () {

                if($(this).is(':checked'))
                {
                    var prodId=$(this).attr("name").substring(14);
                    selected += prodId+",";
                }

            });

            selected = selected.replace(/,\s*$/, "");

            $("#selectedCancelProducts").val(selected);

            if(selected =="")
            {
                evt.preventDefault();
            }
        });
    });

</script>
@endsection