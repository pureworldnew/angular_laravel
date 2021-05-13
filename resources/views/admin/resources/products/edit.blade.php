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
                <h1>{{ trans('admin/resources/productsForm.editHeading') }}</h1>

                {!! Form::model($product, ['method' => 'PATCH', 'action' => ['ProductController@update', $product->id], /*'url' => 'admin/resources/categories', */'files' => true, 'class' => 'form-horizontal']) !!}
                    @include('admin.resources.products.form', ['submitButtonType' => 'edit'])
                {!! Form::close() !!}
                {{--
                {!! Form::model($article, ['method' => 'PATCH', 'action' => ['articles.update', $article->id], 'files' => false, 'class' => 'form-horizontal']) !!}
                    @include('admin.resources.products.form', ['submitButtonText' => 'add article']);
                {!! Form::close() !!}--}}
            </div>
        </div>
    </div>
@endsection
