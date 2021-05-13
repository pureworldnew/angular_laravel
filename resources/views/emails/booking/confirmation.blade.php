@extends('app')

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        }

    </style>
    <div class="row">
        <div class="col-sm-10 contentBoxHolder">
            <div class="contentBox">
                @include("partials.bookingBreadcrumbs")
                {!! $klarnaSnippet !!}

                @if ($stripeMessage <> "")
                    <p>{!! $stripeMessage !!}</p>
                @endif

                {{ trans('booking/confirmation.confirmationMessage') }}
                <p>{{ $centreDetails->confirmation_text }}</p>

                <b>{{ trans('booking/confirmation.bookedItems') }}</b><br>

                <ul>
                    @foreach($booking->products as $product)
                        <li>{{ $product->name }}</li>
                    @endforeach
                </ul>

                {{ $centreDetails->booking_conditions }}


                <p>
                    {!! Form::open(array('url' => '', 'method' => 'get')) !!}

                            {!! Form::submit(trans('booking/confirmation.printText'), array('class' => 'btn btn-default')) !!}
                    {!! Form::close() !!}
                </p>
            </div>
        </div>
    </div>
@endsection