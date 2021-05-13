@extends('app')

@section('content')
    <input type="hidden" id="refresh" value="no">
    <style>
        .shoppingCartProductHeading {
            font-weight:bold;
        }
        .priceMessage {
            color: #286090;
            font-size: 1.4em;
            padding-top: 30px;
            font-weight: bold;
        }
        #productTable .glyphicon {
            display:none;

        }
        #productTable {
            padding-top: 0;
        }
        #productTable .searchResult h3 {

            margin-top:0;
        }
        #productTable .searchResult {
            border-bottom: 1px solid #eee;
            padding: 30px 0;
        }

        #productTable .glyphicon.spinning {
            animation: spin 1s infinite linear;
            -webkit-animation: spin2 1s infinite linear;
            display: inline-block !important;
        }

        @keyframes spin {
            from { transform: scale(1) rotate(0deg); }
            to { transform: scale(1) rotate(360deg); }
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg); }
            to { -webkit-transform: rotate(360deg); }
        }
        /*.contentBoxHolder {
            !*margin: 20px 0 0 0;*!
            padding: 0 10px;
        }*/

        .clearBoth {
            clear: both;
            height: 0;
        }

        #searchFields .form-group  {
            /*width:23.5%;*/
        }
        #searchFields h2 {
            margin-top:0;
        }
        #searchFields h4 {
            margin-top: -10px;
        }

        #searchFields .form-group input {
            width:100%;
        }
        .bookingSection {
            background-color: #eee;
        }
        .bookingOption {
            cursor: pointer;
        }
        .bookingOption.selected {
            background-color: #337AB7;
            color:white;
        }

        .contentBox {
            margin: 20px 0 0 0;
            border: 1px solid #eee;
            padding: 3%;
        }

        .floatRight {
            margin: 30px;
            float:right;
        }
        #shoppingCart img, #showResults img {
            width:150px;
            height:150px;
        }
        .primaryCategory img, .subCategory img {
            width: 49%;
        }
        /*#productTable .quantity, #productTable .howLong {
            width: 15%;
        }*/
    </style>
    @include("partials.bookingBreadcrumbs")

    @if(Session::has('message'))
        <h3 style="color:blue;font-weight: 1.3em;">{{ Session::get('message') }}</h3>
    @endif


    <div id="vueApp">
             <div class="row">
                <div class="col-sm-10">
                    <h1>{{ trans('booking/index.heading') }}</h1>
                    {{ trans('booking/index.description') }}

                    <h2>{{ trans('booking/index.subHeading') }}</h2>
                </div>
                <div class="col-sm-2">
                    <h4 v-show="afterInitialLoad" style="display:none">{{ trans('booking/index.totalPrice') }}:</h4>
                    <h2 v-show="afterInitialLoad" style="display:none">@{{ totalPrice }} kr</h2>
                   {{-- <h2 v-show="afterInitialLoad" style="display:none">@{{ testFunc() }} kr</h2>
                    <h2 v-show="afterInitialLoad" style="display:none">@{{ testFunc2() }} kr</h2>--}}
                    {{--<h2 v-show="afterInitialLoad" style="display:none">@{{ totalPrice }} kr</h2>--}}

                    <br/>
                    <br/>
                    @if(isset($booking->id))
                    <div style="display:none" v-show="shoppingCart.length > 0">
                        {!! Form::open(array('url' => '/booking/empty-cart', 'method' => 'post', 'class' => 'emptyCartLink')) !!}
                            {!! Form::hidden('bookingId', $booking->id) !!}
                            {!! Form::submit(trans('booking/index.cartEmpty'), array('class' => 'btn btn-warning')) !!}
                        {!! Form::close() !!}
                    </div>
                    @endif
                </div>
            </div>
        {!! Form::open(['method' => 'get', 'url' => 'availability/search', 'class' => 'form-horizontal form-inline', '@submit.prevent' => 'searchSubmit']) !!}


        <div class="row">
            <div class="col-sm-2 contentBoxHolder">
                <div class="contentBox bookingSection">
                    {{ trans('booking/index.categoryHeading') }}
                </div>
            </div>
            <div class="col-sm-10 contentBoxHolder">
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-sm-2 contentBoxHolder">
                            <div v-on:click="parentClick" class="contentBox bookingOption primaryCategory parentId{{ $category->id }}">
                                @if($category->image <> "")
                                    <img src="images/categories/{{ $category->image }}" alt="{{ $category->name }}"/>
                                @endif
                                {{ $category->name }}
                            </div>
                        </div>
                    @endforeach
                    {{--<div class="col-sm-2 contentBoxHolder">
                        <div class="contentBox bookingOption">
                            Kanadensare
                        </div>
                    </div>
                    <div class="col-sm-2 contentBoxHolder">
                        <div class="contentBox bookingOption">
                            Kajak
                        </div>
                    </div>
                    <div class="col-sm-2 contentBoxHolder">
                        <div class="contentBox bookingOption">
                            Segelbåtar
                        </div>
                    </div>
                     <div class="col-sm-2 contentBoxHolder">
                        <div class="contentBox bookingOption">
                            Boende
                        </div>
                    </div>
                     <div class="col-sm-2 contentBoxHolder">
                        <div class="contentBox bookingOption">
                            Campingutrustning
                        </div>
                    </div>
                     <div class="col-sm-2 contentBoxHolder">
                        <div class="contentBox bookingOption">
                            Kurspaket
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>


        <div style="display:none" class="row" v-show="showSubCategories">
            <div class="col-sm-2 contentBoxHolder">
                <div class="contentBox bookingSection">
                    {{ trans('booking/index.subCategoryHeading') }}
                </div>
            </div>
            <div class="col-sm-10 contentBoxHolder">
                <div class="row">

                    @foreach($subCategories as $category)

                        <div class="col-sm-4 contentBoxHolder">
                            <div v-on:click="childClick"  class="subCategory contentBox bookingOption childOf{{ $category->parent_category_id }} categoryId{{ $category->id }}">
                                @if($category->image <> "")
                                    <img src="images/categories/{{ $category->image }}" alt="{{ $category->name }}"/>
                                @endif
                                {{ $category->name }}
                            </div>
                        </div>

                    @endforeach


                    {{--<div class="col-sm-4 contentBoxHolder">
                        <div class="contentBox bookingOption">
                            Kanadensare för 2 personer
                        </div>
                    </div>
                    <div class="col-sm-4 contentBoxHolder">
                        <div class="contentBox bookingOption">
                            Kanadensare för 3 personer
                        </div>
                    </div>
                    <div class="col-sm-4 contentBoxHolder">
                        <div class="contentBox bookingOption">
                            Kanadensare för forspaddling
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>

        <div  style="display:none" class="row" v-show="showSearchCriteria">
            <div class="col-sm-2 contentBoxHolder">
                <div class="contentBox bookingSection">
                    {{ trans('booking/index.availability') }}
                </div>
            </div>
            <div class="col-sm-10 contentBoxHolder">
                <div class="row">
                    <div class="col-sm-12 contentBoxHolder">
                        <div class="row">
                            <div class="contentBox " id="searchFields">
                                {{--<div class="form-group">
                                    {!! Form::text('quantity', null, array('v-model' => 'quantity', 'class' => 'form-control', 'placeholder' => trans('booking/index.quantity'))) !!}
                                </div>--}}
                                <div class="col-sm-10">
                                    {!! Form::hidden('quantity', 1, array('v-model' => 'quantity', 'class' => 'form-control', 'placeholder' => trans('booking/index.quantity'))) !!}
                                    <div class="form-group">
                                        {!! Form::text('startDate', null, array("id" => "startDate", 'v-model' => 'startDate', 'class' => 'form-control startDate', 'placeholder' => trans('booking/index.date'))) !!}
                                    </div>
                                    {{--<div class="form-group">
                                        {!! Form::text('durationDays', null, array('v-if' => 'timeType==1', 'v-model' => 'durationDays', 'class' => 'form-control', 'placeholder' => trans('booking/index.durationDays'))) !!}
                                        {!! Form::text('durationHours', null, array('v-if' => 'timeType==3', 'v-model' => 'durationHours', 'class' => 'form-control', 'placeholder' => trans('booking/index.durationHours'))) !!}
                                    </div>--}}
                                    <div class="form-group">
                                        {!! Form::submit(trans('booking/index.searchButton'), array('class' => 'btn btn-success')) !!}
                                    </div>
                                </div>
                                {{--<div class="col-sm-2">
                                    <h4>Total price:</h4>
                                    <h2>@{{ totalPrice }} kr</h2>
                                </div> <br class="clearBoth"/>--}}
                                <br class="clearBoth"/>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        {!! Form::close() !!}


        <div style="display:none" id="noResults" v-show='noResults'>
            <h3>{{ trans('booking/index.noResultsHeading') }}</h3>
            <p>{{ trans('booking/index.noResultsText') }}</p>
        </div>

        {{--***********************************   Search Results  ***********************************   --}}
        <div style="display:none" id="showResults" v-show='showResults'>
            <div class="row">
                <div class="col-sm-2 contentBoxHolder">
                    <div class="contentBox bookingSection">
                        {{ trans('booking/index.productHeading') }}
                    </div>
                </div>
                <div class="col-sm-10 contentBoxHolder">
                    <div class="row">
                        <div class="col-sm-12 contentBoxHolder">
                            <div id="productTable" class="contentBox">
                                <div class="row searchResult" v-for="result in results">
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3>@{{ result.name }}</h3>
                                                <img v-if="result.product_images[0].image" src="/images/products/@{{ result.product_images[0].image }}"/>

                                                <p v-if="Math.round(parseFloat(result.prices[2].pivot.price)) != 0 && (results[$index].price === undefined || results[$index].price == 0)">{{ trans('booking/index.costs') }} @{{ Math.round(parseFloat(result.prices[2].pivot.price)) }} {{ trans('booking/index.currency') }} {{ trans('booking/index.perDay') }}<br></p>

                                                <br>
                                                @{{ result.description }}<br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p v-show="results[$index].price !== undefined" class="priceMessage">@{{ results[$index].priceMessage }} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-7">
                                        <form {{--class="form-inline" --}}@submit.prevent='addToCart(result.id, $index)'>
                                            {{--<input v-model='results[$index].startDate' index="@{{ $index }}" v-datepicker="results[$index].startDate" class="form-control startDate" placeholder="Enter date (yyyy-mm-dd)" type="text">--}}

                                            {{--{!! Form::text(null, null, array("v-if" => "!timeType", 'v-model' => 'results[$index].startDate', 'class' => 'form-control startDate', 'placeholder' => trans('booking/index.date'), 'v-datepicker' => 'results[$index].startDate')) !!}--}}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group" v-if="result.per_type_id == 1 || result.per_type_id == 3">
                                                        <label for="startTime">{{ trans('booking/index.startTime') }}:</label>
                                                        <select name="startTime" v-model='results[$index].startTime' class="form-control input selectBox">
                                                            <option v-for="(timeIndex, time) in result.start_times">@{{ time.start_time }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group" v-if="result.per_type_id == 1">
                                                        <label for="productTimeType">{{ trans('booking/index.durationType') }}:</label>
                                                        <select name="productTimeType" v-model='results[$index].productTimeType' class="form-control input selectBox productTimeType">
                                                            <option v-for="time in result.per_type_times" value="@{{ time.id }}">@{{ time.type_time_name }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {!! Form::button('<span class="glyphicon glyphicon-refresh"></span>'.trans('booking/index.getPriceAvail'), array('class' => 'btn btn-default', 'v-on:click' => 'getPriceAvail($index, result)', 'id' => 'getPriceAvail@{{ $index }}', 'v-bind:disabled' => '!(result.per_type_id == "1" && result.quantity && (result.durationDays || result.durationHours)) && !(result.per_type_id == 3 && result.quantity)')) !!}
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group"  v-if="result.per_type_id == 1">
                                                        <label for="durationDays">{{ trans('booking/index.theDuration') }}:</label>
                                                        {!! Form::text('durationDays', null, array("autocomplete"=> "off",/*'v-on:keyup' => 'keyupDurationDays($event, $index)', */'v-if' => 'parseInt(results[$index].productTimeType,10)==2', 'v-model' => 'results[$index].durationDays', 'class' => 'form-control howLong', 'placeholder' => trans('booking/index.durationDays'))) !!}
                                                        {!! Form::text('durationHours', null, array("autocomplete"=> "off",/*'v-on:keyup' => 'keyupDurationHours($event, $index)',*/ 'v-if' => 'parseInt(results[$index].productTimeType,10)==1', 'v-model' => 'results[$index].durationHours', 'class' => 'form-control howLong', 'placeholder' => trans('booking/index.durationHours'))) !!}
                                                    </div>

                                                    {{--{{ Form::select(null, array("" => trans('booking/index.allTimeTypes'), '1' => trans('booking/index.wholeDay'), '2' => trans('booking/index.halfDay'), '3' => trans('booking/index.perHour')), 3, array("v-if" => "!timeType", 'v-model' => 'results[$index].productTimeType', 'class' => 'form-control input-lg')) }}<br>--}}
                                                    {{--<select v-model="results[$index].productTimeType" class="form-control input"><option value="" --}}{{--selected="selected"--}}{{-->All types</option><option value="1">Whole day</option><option value="2">Half day</option><option value="3">Per hour</option></select>--}}


                                                    <div class="form-group">
                                                        <label for="quantity">{{ trans('booking/index.quantity') }}:</label>
                                                        {!! Form::text('quantity', null, array("autocomplete"=> "off",/*'v-on:keyup' => 'keyupQuantity($event, $index)',*/'v-model' => 'results[$index].quantity', 'class' => 'form-control input quantity', 'placeholder' => 'Quantity')) !!}
                                                        {{--    <select name="quantity" v-model='results[$index].quantity' v-on:change="changeQuantity($index)" class="form-control input selectBox">
                                                                <option v-for="(key, quantity) in result.quantityArray">@{{ quantity }}</option>
                                                            </select>--}}
                                                    </div>


                                                    {{--{!! Form::button('<span class="glyphicon glyphicon-refresh"></span>'.trans('booking/index.getPriceAvail'), array('class' => 'btn btn-default', 'v-on:click' => 'getPriceAvail($index)', 'id' => 'getPriceAvail@{{ $index }}', 'v-bind:disabled' => '!results[$index].hasPriceAvailCriteria')) !!}--}}

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {!! Form::button('<span class="glyphicon glyphicon-refresh"></span>'.trans('booking/index.addToBooking'), array('class' => 'btn btn-primary dynamic-button', 'v-on:click' => 'addToCart($index, result)', 'id' => 'addToBookingButton@{{ $index }}', 'v-bind:disabled' => '!(result.per_type_id == "1" && result.quantity && (result.durationDays || result.durationHours)) && !(result.per_type_id == 3 && result.quantity)')) !!}

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>



                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="row" style="display:none" v-show='(shoppingCart.length > 0)'>
            <div class="col-sm-2 contentBoxHolder">
                <div class="contentBox bookingSection">
                    {{ trans('booking/index.chosenHeading') }}
                </div>
            </div>
            <div class="col-sm-10 contentBoxHolder">
                <div class="row">
                    <div class="col-sm-12 contentBoxHolder">
                        <div class="contentBox">
                            @include('partials/selectedProducts')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:none" id="bookingId">@if($booking <> ""){{ $booking->id }}@endif</div>
        <div style="display:none" v-model="bookingToken" id="bookingToken">@if($booking <> ""){{ $booking->token }}@endif</div>

        <div style="display:none" id="deleteSureMessage">{{ trans('booking/index.deleteSureMessage') }}</div>

        {!! Form::open(array('url' => 'booking/confirm', 'class' => "floatRight")) !!}
            {!! Form::hidden("bookingId" , null, array('v-model' => 'bookingId' )) !!}
            {!! Form::submit(trans('booking/index.continue'), $nextButtonArray) !!}
        {!! Form::close() !!}

       {{-- <pre>
            @{{ $data | json }}
        </pre>--}}
        <div style="display:none" id="noZeroQuantity">{{ $javascriptMessages['noZeroQuantity'] }}</div>
        <div style="display:none" id="addToCartSuccess">{{ $javascriptMessages['addToCartSuccess'] }}</div>
        <div style="display:none" id="notEnough">{{ $javascriptMessages['notEnough'] }}</div>
    </div>
@endsection
@section("footerFirst")

@endsection

@section("footer")
    <script src="/js/booking.js"></script>
    {{--<script src="jsTemp/booking.js"></script>--}}
<script>
    $(document).ready(function(e) {
        var $input = $('#refresh');

        $input.val() == 'yes' ? location.reload(true) : $input.val('yes');
    });
</script>
@endsection