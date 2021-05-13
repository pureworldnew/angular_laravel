@extends('app')

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        }
        .adminTable tr form {
            display:inline;
        }
    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div class="contentBox">
                @include("admin.resources.resourcesNav")
                 @if(sizeof($userCentreProducts) > 0)
                    <p><a href="/admin/resources/products/create" class="btn btn-success">{{ trans('admin/resources.newArticle') }} »</a></p>

                    <table class="table table-striped adminTable">
                        <tr>
                            <th>{{ trans('admin/resources.tableProduct') }}</th>
                            <th>{{ trans('admin/resources.tableProductDescription') }}</th>
                            <th>{{ trans('admin/resources.tableProductImage') }}</th>
                            @foreach($priceTypes as $priceType)
                                <!-- <th>{{ trans('admin/resources.tablePrice'.$priceType->shortCode) }}</th> -->
                            @endforeach
                            <th></th>
                        </tr>
                        @foreach($userCentreProducts as $product)
                            <tr>
                                <td><a href="{!! '/admin/resources/products/'.$product->id.'/edit' !!}">{{ $product->name }}</a></td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    @if (isset($product->product_images()->first()->image) AND $product->product_images()->first()->image <> "")
                                        <img style="width:50px;" src="/images/products/{{ $product->product_images()->first()->image }}"/>
                                    @endif
                                </td>
                                @foreach($product->prices()->get() as $productPrice)
                                    <!-- <td>{{ $productPrice->pivot->price }}</td> -->
                                @endforeach
                                <td class="text-right">
                                  <!-- {!! Form::open(['url' => 'products', 'method' => 'GET']) !!}
                                  {!! Form::submit(trans('admin/resources.tableNew'), array('class' => 'btn btn-default')) !!}
                                  {!! Form::close() !!} -->

                                  <!-- {!! Form::open(['url' => '/admin/resources/products/'.$product->id.'/edit', 'method' => 'GET']) !!}
                                  {!! Form::submit(trans('admin/resources.tableEdit'), array('class' => 'btn btn-primary btn-xs')) !!}
                                  {!! Form::close() !!} -->

                                  {!! Form::open(['url' => 'admin/resources/products/'.$product->id, 'method' => 'DELETE']) !!}
                                  {!! Form::submit(trans('admin/resources.tableDelete'), array('class' => 'btn btn-danger btn-xs')) !!}
                                  {!! Form::close() !!}
                            </tr>
                        @endforeach

                    </table>
                 @else
                    <h2>{{ trans('admin/resources.noProductsAvailable') }}:</h2>

                    {!! Form::open(['url' => 'admin/resources/products', 'files' => true, 'class' => 'form-horizontal']) !!}
                    @include('admin.resources.products.form', ['submitButtonType' => 'add'])
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

@endsection
