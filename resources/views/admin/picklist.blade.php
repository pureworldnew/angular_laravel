@extends('app')

@section('meta')
    <meta http-equiv="Refresh" content="60">
@endsection

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        }

    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div class="contentBox">
                <br/><br/>
                @if(Session::has('flashMessage'))
                    <p style="color:blue;font-weight: 1.3em;">{{ Session::get('flashMessage') }}</p>
                @endif
                <h1>{{ trans('admin/picklist.heading') }} <small>{{ $currentTime }}</small></h1>
                {{--<div class="form-inline">
                    <button class="btn btn-primary">{{ trans('admin/picklist.categoryFilterButtonText') }}</button>
                    <button class="btn btn-primary">{{ trans('admin/picklist.productFilterButtonText') }}</button>
                    <input type="text" class="form-control" placeholder="{{ trans('admin/picklist.searchStartDatePlaceholder') }}">
                    <input type="text" class="form-control" placeholder="{{ trans('admin/picklist.searchEndDatePlaceholder') }}">
                    <button class="btn btn-primary">{{ trans('admin/picklist.searchButtonText') }}</button>
                </div>
                <br/>--}}
                <table class="table table-striped" id="picklist-table">
                    <tr>
                        <th>{{ trans('admin/picklist.bookingtime') }}</th>
                        <th>{{ trans('admin/picklist.customerName') }}</th>
                        <th>{{ trans('admin/picklist.bookingduration') }}</th>
                        <th>{{ trans('admin/picklist.itemsBooked') }}</th>
                        <th>{{ trans('admin/picklist.bookingPayed') }}</th>
                        <th>{{ trans('admin/bookings.bookingTableOrderDetails') }}</th>
                    </tr>

                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking['readyTime'] }}</td>
                            <td>
                                {{ $booking['bookingName'] }}<br>
                                <a href="mailto:{{ $booking['email'] }}">
                                    {{ $booking['email'] }}
                                </a><br>
                                {{ $booking['telephone'] }}
                            </td>
                            <td>
                                @foreach($booking['times'] as $time)
                                    {{ $time }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach($booking['products'] as $product)
                                    {{ $product }}<br>
                                @endforeach
                            </td>
                            <td>
                                @if ($booking["payment_method"] <> "")
                                    {{ trans('admin/bookings.paymentMethod'.$booking["payment_method"]) }}
                                @endif
                            </td>
                            <td>
                                <a href="/admin/booking/{{$booking['id']}}">
                                    {{ trans('admin/picklist.bookingId') }} #{{ $booking['id'] }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("picklist-table");
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc";
            /* Make a loop that will continue until
             no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.getElementsByTagName("TR");
                /* Loop through all table rows (except the
                 first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                     one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /* Check if the two rows should switch place,
                     based on the direction, asc or desc: */
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                     and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Each time a switch is done, increase this count by 1:
                    switchcount ++;
                } else {
                    /* If no switching has been done AND the direction is "asc",
                     set the direction to "desc" and run the while loop again. */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
        sortTable(0);
    </script>
@endsection
