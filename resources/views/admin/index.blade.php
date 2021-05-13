@extends('app')

@section('content')
    <div class="jumbotron">
        <h1>{{ trans('index.adminHeading') }}!</h1>
        <p>{{ trans('index.adminWelcomeMessage') }}</p>
        <br>
        <p>
            <a href="{{ $linkToForm }}" class="btn btn-success btn-lg">{{ trans('index.adminRegisterLink') }} »</a>
        </p>
    </div>

@endsection
