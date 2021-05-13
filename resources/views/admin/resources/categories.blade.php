@extends('app')

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        }
        .adminTable tr form {
            display:inline;
        }
        /*.subTable {
            width:90%;
            margin-left:5%;
        }*/

    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="contentBox">
                @include("admin.resources.resourcesNav")
                @if(sizeof($userCentreCategories) > 0)
                    <p><a href="/admin/resources/categories/create" class="btn btn-success">{{ trans('admin/resources.newCategory') }} »</a></p>


                    <table class="table table-striped adminTable">


                        @foreach($userCentreCategories as $category)

                            <tr>
                                <th>{{ trans('admin/resources.tableTitle') }}</th>
                                <th>{{ trans('admin/resources.tableDescription') }}</th>
                                <th>{{ trans('admin/resources.tableImage') }}</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td><a href="{!! '/admin/resources/categories/'.$category->id.'/edit' !!}">{{ $category->name }}</a></td>
                                <td>{{ $category->description }}</td>
                                <td>@if (isset($category->image) and $category->image <> "")
                                        <img style="width:50px;" src="/images/categories/{{ $category->image }}"/>
                                    @endif
                                </td>

                                <td class="text-right">
                                  <!-- {!! Form::open(['url' => '/admin/resources/categories/create', 'method' => 'GET']) !!}
                                  {!! Form::submit(trans('admin/resources.tableNew'), array('class' => 'btn btn-default btn-xs')) !!}
                                  {!! Form::close() !!} -->

                                  <!-- {!! Form::open(['url' => '/admin/resources/categories/'.$category->id.'/edit', 'method' => 'GET']) !!}
                                  {!! Form::submit(trans('admin/resources.tableEdit'), array('class' => 'btn btn-primary btn-xs')) !!}
                                  {!! Form::close() !!} -->
                                @if(!$category->is_admin_category)
                                  {!! Form::open(['url' => '/admin/resources/categories/'.$category->id, 'method' => 'DELETE']) !!}
                                  {!! Form::submit(trans('admin/resources.tableDelete'), array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('This will remove the category ".$category->name.". Are you sure?');")) !!}
                                  {!! Form::close() !!}
                                @endif
                            </tr>
                            @if(sizeof($category->childCategories) > 0)

                                {{--</table>
                                <table class="table subTable">--}}
                                @foreach($category->childCategories as $childcategory)

                                    <tr>
                                        <td> > <a href="{!! '/admin/resources/categories/'.$childcategory->id.'/edit' !!}">{{ $childcategory->name }}</a></td>
                                        <td>{{ $childcategory->description }}</td>
                                        <td>@if (isset($childcategory->image) and $childcategory->image <> "")
                                                <img style="width:50px;" src="/images/categories/{{ $childcategory->image }}"/>
                                            @endif
                                        </td>

                                        <td class="text-right">
                                        <!-- {!! Form::open(['url' => '/admin/resources/categories/create', 'method' => 'GET']) !!}
                                        {!! Form::submit(trans('admin/resources.tableNew'), array('class' => 'btn btn-default btn-xs')) !!}
                                        {!! Form::close() !!} -->

                                        <!-- {!! Form::open(['url' => '/admin/resources/categories/'.$childcategory->id.'/edit', 'method' => 'GET']) !!}
                                        {!! Form::submit(trans('admin/resources.tableEdit'), array('class' => 'btn btn-primary btn-xs')) !!}
                                        {!! Form::close() !!} -->

                                        @if(!$category->is_admin_category)
                                        {!! Form::open(['url' => '/admin/resources/categories/'.$childcategory->id, 'method' => 'DELETE']) !!}
                                        {!! Form::submit(trans('admin/resources.tableDelete'), array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('{{ trans('admin/resources.thisWillRemoveCategory') }} ".$category->name.". {{ trans('admin/resources.areYouSure') }}');")) !!}
                                        @endif
                                        {!! Form::close() !!}
                                    </tr>

                                @endforeach
                                </table>
                <br/><br/><br/>
                                <table class="table">

                            @endif
                        @endforeach


                        </table>
                    @else

                        <h2>{{ trans('admin/resources.noCategoriesAvailable') }}:</h2>

                        {!! Form::open(['url' => 'admin/resources/categories', 'files' => true, 'class' => 'form-horizontal']) !!}
                            {!! Form::hidden('firstCategory', 1) !!}
                            @include('admin.resources.categories.form', ['submitButtonType' => 'add'])
                        {!! Form::close() !!}
                    @endif

            </div>
        </div>
    </div>

@endsection
