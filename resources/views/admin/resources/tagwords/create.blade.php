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
                <h1>{{ trans('admin/resources/add.addtag') }}</h1>

                {!! Form::open(['url' => 'admin/resources/tagwords', 'files' => true, 'class' => 'form-horizontal']) !!}
                    @include('admin.resources.tagwords.form', ['submitButtonType' => 'add'])
                {!! Form::close() !!}
                {{--
                {!! Form::model($article, ['method' => 'PATCH', 'action' => ['articles.update', $article->id], 'files' => false, 'class' => 'form-horizontal']) !!}
                    @include('admin.resources.tagwords.form', ['submitButtonText' => 'add article']);
                {!! Form::close() !!}--}}
            </div>
        </div>
    </div>
@endsection
