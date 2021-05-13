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
<input id="searchDateTime" name="searchDateTime"/>
{!! Form::submit(trans('admin/reports/bookingTable.searchButton'), array('class' => 'btn btn-success')) !!}
{!! Form::close() !!}

<table class="table">
    <tr>
        <th>Datum</th>
        <th>Tid</th>
        <th>Kund</th>
        <th>Handelse</th>
        <th>Anmarkning</th>
    </tr>
    @foreach($bookings as $booking)
        <tr>
            <td>{{ substr($booking->startDateTime, 0, 10) }}</td>
            <td>{{ substr($booking->startDateTime, 10) }}</td>
            <td>{{ $booking->bookingName }}</td>
            <td>{{ $booking->productName }}</td>
            <td></td>
        </tr>
    @endforeach

</table>