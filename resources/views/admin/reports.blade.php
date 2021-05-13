@extends('app')

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        }

       /* #timeline {
            width: 50%;
        }
        #timelinePerHour {
            width: 50%;
        }*/
    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div class="contentBox">
                @include("admin.resources.reportsNav")
                @if ($reportType == "gantt")
                    {{--<p>{{ trans('admin/reports.date') }}: <input type="date" value="2016-03-01"/> – <input type="date" value="2016-04-01"/></p> <p>{{ trans('admin/reports.date') }}</p>--}}


                    @include('admin/reports/gantt')
                    {{--<img src="/images/reporting.png"/>--}}
                @elseif($reportType == "table")
                    <p>{{ trans('admin/reports.filter') }}: <span id="filterDate"></span></p>
                    @include('admin/reports/bookingsTable')

                @elseif($reportType == "customers")
                    @include('admin/reports/customersTable')
                @endif

            </div>
        </div>
    </div>

@endsection
