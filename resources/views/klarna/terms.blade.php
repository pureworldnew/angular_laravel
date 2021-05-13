@extends('app')

@section('content')
    @if($logo <> "")
        <img id="mainLogo" src="{{ $logo }}" />
    @endif
    <p>{{ $bookingConditions }}</p>

    <p><a href="/booking">Click here to make a booking</a></p>
@endsection