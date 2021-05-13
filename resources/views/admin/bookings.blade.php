@extends('app')

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        }

    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div class="contentBox">
                <br/><br/>
                @if(Session::has('flashMessage'))
                    <p style="color:blue;font-weight: 1.3em;">{{ Session::get('flashMessage') }}</p>
                @endif
                <h1>{{ trans('admin/bookings.heading') }}</h1>
                {{--<div class="form-inline">
                    <button class="btn btn-primary">{{ trans('admin/bookings.categoryFilterButtonText') }}</button>
                    <button class="btn btn-primary">{{ trans('admin/bookings.productFilterButtonText') }}</button>
                    <input type="text" class="form-control" placeholder="{{ trans('admin/bookings.searchStartDatePlaceholder') }}">
                    <input type="text" class="form-control" placeholder="{{ trans('admin/bookings.searchEndDatePlaceholder') }}">
                    <button class="btn btn-primary">{{ trans('admin/bookings.searchButtonText') }}</button>
                </div>
                <br/>--}}
                <table class="table table-striped">
                    <tr>
                        <th>{{ trans('admin/bookings.bookingId') }}</th>
                        <th>{{ trans('admin/bookings.customerName') }}</th>
                        <th>{{ trans('admin/bookings.noItemsBooked') }}</th>
                        <th>{{ trans('admin/bookings.bookingTotalPrice') }}</th>
                        <th>{{ trans('admin/bookings.bookingTableOrderStatus') }}</th>
                        <th>{{ trans('admin/bookings.bookingTableOrderDetails') }}</th>
                        <th>{{ trans('admin/bookings.bookingTableOrderActivate') }}</th>
                        <th>{{ trans('admin/bookings.bookingTableOrderRegisterPayment') }}</th>
                        <th>{{ trans('admin/bookings.bookingTablePaymentDate') }}</th>
                    </tr>

                    @foreach($bookings as $booking)
                        <tr>
                            <td>
                                {{ $booking->id }}
                            </td>
                            <td>
                                {{ $booking->name }}
                            </td>
                            <td>
                                {{ sizeof($booking->products) }}
                            </td>
                            <td>{{ $booking->totalPrice() }} {{ Config('booking.currencySymbol') }}</td>
                            <td>
                                @if ($booking->getBookingStatus() == "New")
                                    <span style='font-weight:bold;color:blue;'>
                                @endif
                                        {{ trans('admin/bookings.bookingStatus'.$booking->getBookingStatus()) }}
                                @if ($booking->getBookingStatus() == "New")
                                    </span>
                                @endif
                            </td>
                            <td><a href="/admin/booking/<?php echo $booking->id;?>">{{ trans('admin/bookings.bookingOrderDetails') }}</a></td>
                            <td>
                                @if ($booking->isNew())

                                    {!! Form::open(array('url' => '/admin/booking/activate', "class" => "form-inline")) !!}
                                        <input type="hidden" name="bookingId" value="{{  $booking->id }}"/>
                                        <input type="submit" value="{{ trans('admin/bookings.bookingActivateBooking') }}"/>
                                    {!! Form::close() !!}

                                @elseif ($booking->isCancelled() )
                                    {{ trans('admin/bookings.bookingStatusCancelled') }}
                                @elseif ($booking->isCredited() )
                                    {{ trans('admin/bookings.bookingStatusCredited') }}
                                @else
                                    {{ trans('admin/bookings.bookingOrderActivated') }}
                                @endif

                            </td>
                            <td>
                                @if ($booking->isActivated())
                                    @if ($booking->paymentMethodIsCash() or $booking->paymentMethodIsTransfer() or $booking->paymentMethodIsInvoice())
                                        {!! Form::open(['url' => '/admin/booking/registerPayment', 'method' => 'post', 'files' => false, 'class' => 'form-horizontal']) !!}
                                        <input type="hidden" name="bookingId" value="<?php echo $booking->id; ?>"/>
                                        <input type="submit" value="{{ trans('admin/bookings.bookingTableOrderRegisterPayment') }}"/>
                                        {!! Form::close() !!}
                                    @endif
                                @elseif (($booking->paymentMethodIsCash() or $booking->paymentMethodIsTransfer() or $booking->paymentMethodIsInvoice()) AND $booking->isPaid())
                                    {!! Form::open(['url' => '/admin/booking/unregisterPayment', 'method' => 'post', 'files' => false, 'class' => 'form-horizontal']) !!}
                                    <input type="hidden" name="bookingId" value="<?php echo $booking->id; ?>"/>
                                    <input type="submit" value="{{ trans('admin/bookings.bookingTableOrderDeRegisterPayment') }}"/>
                                    {!! Form::close() !!}
                                 @endif
                            </td>
                            <td>

                                @if($booking->payment_date <> "0000-00-00 00:00:00")
                                    {{ $booking->payment_date }}
                                @else
                                    {{ trans('admin/bookings.bookingStatusNotPaid') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>


            </div>
        </div>
    </div>

@endsection
