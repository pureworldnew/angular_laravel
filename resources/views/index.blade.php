@extends('app')

@section('content')
    <div class="jumbotron">
      <h1>{{ trans('index.heading') }}!</h1>
      <p>{{ trans('index.welcomeMessage') }}</p>
      <br>
      <p>
        <a href="/register" class="btn btn-success btn-lg">{{ trans('index.registerLink') }} »</a>
        <a href="/login" class="btn btn-primary btn-lg">{{ trans('index.loginLink') }} »</a>
      </p>
    </div>

@endsection
