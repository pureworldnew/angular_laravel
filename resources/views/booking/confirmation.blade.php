@extends('app')

@section('meta')

    <link rel="stylesheet" href="/css/printConfirmation.css" type="text/css" media="print" />

@endsection

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
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
        <div class="col-sm-10 contentBoxHolder">
            <div class="contentBox">
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
                <h1>{{ trans('booking/confirmation.confirmationHeading') }} (#{{$booking->id}})</h1>
                {!! $klarnaSnippet !!}

                @if ($stripeMessage <> "")
                    <p>{!! $stripeMessage !!}</p>
                @endif
                {{ trans('booking/confirmation.confirmationMessage') }}
                <p>{{ $centreDetails->confirmation_text }}</p>

                <p>{{ trans('booking/confirmation.confirmationBookingNumber') }}<b>{{$booking->id}}</b></p>
                <br>
                <b>{{ trans('booking/confirmation.bookedItems') }}</b><br>

                <ul>
                    @foreach($booking->products as $product)
                        <li>{{ $product->name }}</li>
                    @endforeach
                </ul>

                {{ $centreDetails->booking_conditions }}

<br/>
                <p>
                    <a class="printButton" href="javascript:window.print()"><button class='btn btn-default'>{{trans('booking/confirmation.printText')}}</button></a>

                </p>
            </div>
        </div>
    </div>
@endsection