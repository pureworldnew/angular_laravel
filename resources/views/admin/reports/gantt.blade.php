<style>
   /* #timeline {
        width: 50%;
    }*/
   #timelinePerHour div {
    overflow:hidden;
   }
    #timelinePerHour div {
       /* overflow:hidden !important; */
       /* //width: 100%;*/
    }
   #visualization_wrap {

       position: relative;
       padding-bottom: 80%;
       height: 0;
       overflow:hidden;
   }
   #visualization_wrap1 {

       position: relative;
       padding-bottom: 80%;
       height: 0;
       overflow:hidden;
   }
   #timelinePerHour {
       position: absolute;
       top: 0;
       left: 0;
       width:100%;
       height:100%;
   }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['timeline']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var container = document.getElementById('timeline');
        var chart = new google.visualization.Timeline(container);
        var dataTable = new google.visualization.DataTable();

        dataTable.addColumn({ type: 'string', id: 'Position' });
        dataTable.addColumn({ type: 'string', id: 'Name' });
        dataTable.addColumn({ type: 'date', id: 'Start' });
        dataTable.addColumn({ type: 'date', id: 'End' });

        var reportsData = JSON.parse($('#reportsData').html());

        if(reportsData.length > 0) {
            var perDayArray = [];
            perHourArray = [];

            reportsData.forEach(function (row) {
                var perDayRowArray = [];
                var perHourRowArray = [];

                perDayRowArray.push(row.productName);
                perDayRowArray.push(row.bookingName);

                perHourRowArray.push(row.productName);
                perHourRowArray.push(row.bookingName);

                var startDateTimeSplit = row.startDateTime.split(' ');
                var startDateSplit = startDateTimeSplit[0].split('-');
                var startTimeSplit = startDateTimeSplit[1].split(':');

                var endDateTimeSplit = row.endDateTime.split(' ');
                var endDateSplit = endDateTimeSplit[0].split('-');
                var endTimeSplit = endDateTimeSplit[1].split(':');

                perDayRowArray.push(new Date(startDateSplit[0], startDateSplit[1], startDateSplit[2], startTimeSplit[0], startTimeSplit[1]));
                perDayRowArray.push(new Date(endDateSplit[0], endDateSplit[1], endDateSplit[2], endTimeSplit[0], endTimeSplit[1]));
                perDayArray.push(perDayRowArray);

                if(!(startTimeSplit[0] == endTimeSplit[0] && startTimeSplit[1] == endTimeSplit[1]))
                {
                    perHourRowArray.push(new Date("2016", "01", "01", startTimeSplit[0], startTimeSplit[1]));
                    perHourRowArray.push(new Date("2016", "01", "01", endTimeSplit[0], endTimeSplit[1]));
                    perHourArray.push(perHourRowArray);
                }

            });

            dataTable.addRows(perDayArray);
            /*dataTable.addRows([
             [ 'Kayak Explorer #1', 'Adam Alsing', new Date(2015, 3, 1), new Date(2015, 3, 4) ],
             [ 'Kayak Explorer #8', 'Adam Alsing', new Date(2015, 3, 1), new Date(2015, 3, 4) ],
             [ 'Kayak Explorer #5', 'Nils Malm', new Date(2015, 3, 2, 12, 0, 0), new Date(2015, 3, 3, 12, 0, 0) ],
             [ 'Talt #8', 'Smeagul', new Date(2015, 3, 1, 9, 0, 0), new Date(2015, 3, 2, 18, 0, 0) ],

             ]);*/
            chart.draw(dataTable/*, {width: '100%'}*/ /*, {
             height: "100%",
             width: 600
             }*/);


        }
        else
        {
            $("#noBooking").show();
        }
    }
</script>
<br/><br/>
<div id="reportsSubNav" >
    <ul class="nav nav-tabs">
        <li class="active"><a id="graphPerDayLink" href="#">{{ trans('admin/reports.bookingsPerDay') }}</a></li>
        <li class=""><a id="graphPerHourLink" href="#">{{ trans('admin/reports.bookingsPerHour') }}</a></li>
    </ul>
</div>
<br/><br/>
<div id="graphPerDay" >
    <h4>{{ trans('admin/reports.bookingsPerDay') }}</h4>
    <div id="visualization_wrap1">
        <div id="timeline" style="height: 900px;"></div>
    </div>
    <p style="color:red;display: none">{{ trans('admin/reports.noBookings') }}</p>
    <br/>
</div>


    <div id="graphPerHour" style="display:none">
        <h4>{{ trans('admin/reports.bookingsPerHour') }}</h4>
        <h5 id="noPerHourGraph" style="display:none">{{ trans('admin/reports.noBookings') }}</h5>
        <div id="visualization_wrap">
            <div id="timelinePerHour"  style="height:900px;"></div>
        </div>


        <p style="color:red;display: none">{{ trans('admin/reports.noBookings') }}</p>
        <div style="display:none" id="reportsData">{{ $reportsData }}</div>
        {{--<div style="display:none" id="reportsData">[{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":28,"productName":"Admin Fee","bookingName":"James Farrell","startDateTime":"2000-01-01 00:00:00","endDateTime":"2000-01-01 00:00:00"},{"id":24,"productName":"Red canoes","bookingName":"James Farrell","startDateTime":"2016-05-29 09:00:00","endDateTime":"2016-05-29 11:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-05-24 09:00:00","endDateTime":"2016-05-24 10:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-07-22 09:00:00","endDateTime":"2016-07-22 10:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-05-29 09:00:00","endDateTime":"2016-05-29 10:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-05-29 09:00:00","endDateTime":"2016-05-29 10:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-07-08 09:00:00","endDateTime":"2016-07-08 10:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-05-30 09:00:00","endDateTime":"2016-05-30 10:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-07-23 09:00:00","endDateTime":"2016-07-23 10:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-07-20 09:00:00","endDateTime":"2016-07-20 11:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-09-09 09:00:00","endDateTime":"2016-09-09 10:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-06-01 09:00:00","endDateTime":"2016-06-01 11:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-06-02 09:00:00","endDateTime":"2016-06-02 10:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-08-27 09:00:00","endDateTime":"2016-08-27 11:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James farrell","startDateTime":"2016-06-02 09:00:00","endDateTime":"2016-06-02 11:00:00"},{"id":22,"productName":"Sports Kayaks","bookingName":"James Farrell","startDateTime":"2016-10-13 09:00:00","endDateTime":"2016-10-13 11:00:00"},{"id":31,"productName":"TestFail","bookingName":"James Farrell","startDateTime":"2016-06-01 17:00:00","endDateTime":"2016-06-01 18:00:00"},{"id":31,"productName":"TestFail","bookingName":"James Farrell","startDateTime":"2016-06-02 17:00:00","endDateTime":"2016-06-02 18:00:00"},{"id":31,"productName":"TestFail","bookingName":"James Farrell","startDateTime":"2016-10-13 17:00:00","endDateTime":"2016-10-13 19:00:00"}]</div>--}}
    </div>

@section('footer')
    <script>
        $(window).ready(function() {
            $("#graphPerDayLink").click(function (evt) {
                evt.preventDefault();

                $('#graphPerHour').hide();
                $('#graphPerDay').show();

                $(this).parent().addClass('active');
                $("#reportsSubNav li").removeClass("active");
            });
            $("#graphPerHourLink").click(function (evt) {
                evt.preventDefault();
                $('#graphPerDay').hide();
                $('#graphPerHour').show();

                if(typeof perHourArray !== 'undefined' && perHourArray.length > 0)
                {
                    var container2 = document.getElementById('timelinePerHour');
                    var chart2 = new google.visualization.Timeline(container2);
                    var dataTable2 = new google.visualization.DataTable();

                    dataTable2.addColumn({type: 'string', id: 'Position'});
                    dataTable2.addColumn({type: 'string', id: 'Name'});
                    dataTable2.addColumn({type: 'date', id: 'Start'});
                    dataTable2.addColumn({type: 'date', id: 'End'});
                    /*dataTable2.addRows([
                     [ 'Kayak Explorer #5', 'Nils Malm', new Date(2015, 3, 2, 9, 0, 0), new Date(2015, 3, 2, 12, 0, 0) ],
                     [ 'Kayak Explorer #5', 'Nils Malm', new Date(2015, 3, 2, 15, 0, 0), new Date(2015, 3, 2, 18, 0, 0) ],
                     [ 'Talt #8', 'Smeagul', new Date(2015, 3, 2, 9, 0, 0), new Date(2015, 3, 2, 18, 0, 0) ]

                     ]);*/
                    dataTable2.addRows(perHourArray);

                    chart2.draw(dataTable2, {
                        width: '100%'
                    });
                    $(this).parent().addClass('active');
                    $("#reportsSubNav li").removeClass("active");
                }
                else
                {
                    $("#noPerHourGraph").show();
                }
            });
        });
    </script>
@endsection
