@extends('app')

@section('content')
    <style>

    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div class="contentBox">
                <br/><br/>
                <h1>{{ trans('admin/manage.mainHeading') }}</h1>
                <h3>{{ trans('admin/manage.searchLabelText') }}:</h3>

                {!! Form::open(array('url' => '/booking', "class" => "form-inline")) !!}
                    <div class="form-group">
                        {!! Form::text('bookingId', null, array('class' => 'form-control', 'placeholder' => trans('admin/manage.searchPlaceholder'))) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit(trans('admin/manage.searchButtonText'), array('class' => 'btn btn-primary', 'class' => 'form-control')) !!}
                    </div>
                {!! Form::close() !!}

                @if (isset($_POST['bookingId']))

                    <h3>Bokningsnummer: 1234555</h3>

                    <table class="table">

                        <tr>
                            <th>Kategori:</th>
                            <th>Produkt</th>
                            <th>Antal</th>
                            <th>Pris</th>
                        </tr>

                        <tr>
                            <td>Kanot</td>
                            <td>Trapper</td>
                            <td>1</td>
                            <td>100</td>
                        </tr>



                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
