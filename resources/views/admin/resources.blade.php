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
                @include("admin.resources.resourcesNav")

                <h1>{{ trans('admin/resources.mainHeading') }}</h1>

            </div>
        </div>
    </div>

@endsection
