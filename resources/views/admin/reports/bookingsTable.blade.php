@section('footer')

    <script>
        $(document).ready(function(){
            $("#searchDateTime").datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });
    </script>
@endsection

{!! Form::open(['method' => 'get', 'url' => '/admin/reports/table', 'class' => 'form-horizontal form-inline', '@submit.prevent' => 'searchSubmit']) !!}
    <input id="searchDateTime" name="searchDateTime" value="{{ $searchDateTime }}"/>
    {!! Form::submit(trans('admin/reports/bookingTable.searchButton'), array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}
<br/>
<table class="table">
    <tr>
        <th>#</th>
        <th>{{ trans('admin/reports.date') }}</th>
        <th>{{ trans('admin/reports.time') }}</th>
        <th>{{ trans('admin/reports.customerName') }}</th>
        <th>{{ trans('admin/reports.productName') }}</th>
        <th>{{ trans('admin/reports.remark') }}</th>
    </tr>
    @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->bookingId }}</td>
            <td>{{ substr($booking->startDateTime, 0, 10) }}</td>
            <td>{{ substr($booking->startDateTime, 10) }}</td>
            <td>{{ $booking->bookingName }}</td>
            <td>{{ $booking->productName }}</td>
            <td></td>
        </tr>
    @endforeach

</table>