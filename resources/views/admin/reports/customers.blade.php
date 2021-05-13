@extends('app')

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        }

        #timeline {
            width: 50%;
        }
        #timelinePerHour {
            width: 50%;
        }
    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div class="contentBox">
                @include("admin.resources.reportsNav")

                <table class="table">
                    <tr>
                        <th>{{ trans ('admin/reports/customers.thName') }}</th>
                        <th>{{ trans ('admin/reports/customers.thEmail') }}</th>
                        <th>{{ trans ('admin/reports/customers.thDateLastBooking') }}</th>
                        <th>{{ trans ('admin/reports/customers.thNoBookings') }}</th>

                    </tr>
                    @foreach($customers as $customer)
                        @if (strlen($customer->name)>0)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->created_at }}</td>
                            <td>{{ $customer->bookingCount }}</td>
                        </tr>
                        @endif
                    @endforeach

                </table>

            </div>
        </div>
    </div>

@endsection
