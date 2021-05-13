@extends('app')
@section('content')
    <input type="hidden" id="refresh" value="no">
    <style>
        @media (max-width: 767px) {
            .optionsColumn {
                margin-top: 30px;
            }
        }
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
        #mainLogo {
            padding-bottom: 30px;
        }
        /*#productTable .quantity, #productTable .howLong {
            width: 15%;
        }*/
        .store_hours {
            margin-bottom: 10px;
        }
        .store_hours p {
            padding: 0;
            margin: 0;
        }
        .store_name {
            text-transform: capitalize;
            font-size: 35px;
        }
        #valid-error,#valid-errorr{
            color:red;
            display:none;
            font-size: 11px;
        }
        	.dropdown{
          float: right;
         
         /* width: 100px;*/
          height: 30px;
          margin: 20px;
          text-align: center;
         /* line-height: 100px;*/
          color: white;
          text-shadow: 0 1px black;
        }
        .dropdown {
          background: #eee;
          color: black;
        }
        .credentials{
           float: right; 
        }
        .credentials li {
          display: inline;
          width: 115px;
        /*height: 25px;*/
        background: #4E9CAF;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        line-height: 25px;
        }
        .credentials li a {
            color: white;
        }
        .url{
            color: #538ba7;
            font-size:20px;
            
        }
        .column {
          float: left;
          width: 50%;
        }
        
        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
        }
        
        
    </style>
    @if($logo <> "")
        <img id="mainLogo" class="img-responsive" src="{{ $logo }}" />
    @endif
    <!--Store link-->
    @if($user_type == 9)
    <div class="url"><a href="{{$url}}">{{$url}}</a></div>
    @endif
    <div class="store_name">{{$klarnaDetails->name}}</div>
    <div class="store_hours">
        @if (Auth::guest())
        <ul class='credentials'>
          <li><a href="{{'/ulogin'}}">Login</a></li>
          <li><a href="{{'/usignup'}}">Sign Up</a></li>
        </ul>
        @elseif($user_type == 9)
         <li class="dropdown">
        <a href="{{ url('/ulogout') }}" style="color:black"  role="button" aria-expanded="false">
         Logout<span class="caret"></span>
        </a>
      </li>
         <li><ul class="dropdown" role="menu">
            <li><a style="color:black" href="{{url('/frontprofile')}}"><i class="fa fa-btn fa-sign-out"></i>{{ Auth::user()->name }}</a></li>
        </ul></li>
        @else
        @endif
    <p>{{ trans('booking/index.OpeningHours') }} : <?php 
    $date = new DateTime($klarnaDetails->startTime.' 06/13/2013');
    echo $date->format('h:i A') ; ?></p>
    <p>{{ trans('booking/index.ClosingHours') }}: <?php 
    $date = new DateTime($klarnaDetails->endTime.' 06/13/2013');
    echo $date->format('h:i A') ; ?></p>
     
    </div>
    @include("partials.bookingBreadcrumbs")

    @if(Session::has('message'))
        <h3 style="color:blue;font-weight: 1.3em;">{{ Session::get('message') }}</h3>
    @endif
    <!-- For Getting site location -->
    <input type="hidden" value="{{session('applocale')}}" class="getSiteLang"/>
    <div id="vueApp">
        <div class="row">
            <div class="col-sm-10">
                <h1>{{ trans('booking/index.heading') }}</h1>
                {{ trans('booking/index.description') }}

                <h2>{{ trans('booking/index.subHeading') }}</h2>
            </div>
            <div class="col-sm-2">
                @include('partials/priceSnippet')
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
                            @if($category->image <> "")
                                <div v-on:click="parentClick" class="contentBox bookingOption primaryCategory parentId{{ $category->id }}">
                                    <img src="images/categories/{{ $category->image }}" alt="{{ $category->name }}"/>
                                    {{ $category->name }}
                                </div>

                            @elseif(session('applocale') == 'en')
                                <div v-on:click="parentClick" class="btn btn-primary btn-lg contentBox bookingOption primaryCategory parentId{{ $category->id }}">
                                    {{ $category->name }}
                                </div>
                            @elseif(session('applocale') == 'se')
                                 <div v-on:click="parentClick" class="btn btn-primary btn-lg contentBox bookingOption primaryCategory parentId{{ $category->id }}">
                                    {{ $category->name_se }}
                                </div>
                            @elseif(session('applocale') == 'de')
                                 <div v-on:click="parentClick" class="btn btn-primary btn-lg contentBox bookingOption primaryCategory parentId{{ $category->id }}">
                                    {{ $category->name_de }}
                                </div>


                            @endif
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
    <b>{{ trans('booking/index.session') }} </b>
    <p><?php
        $aa = explode(',',$klarnaDetails->holidaysrange); 
        foreach($aa as $k => $v){
            echo $v.'</br>';
        }
    ?></p>
 <input type="hidden" id="holiday" value="{{$klarnaDetails->holidays}}">
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
                            @if($category->image <> "")
                                <div v-on:click="childClick"  class="subCategory contentBox bookingOption childOf{{ $category->parent_category_id }} categoryId{{ $category->id }}">
                                    <img src="images/categories/{{ $category->image }}" alt="{{ $category->name }}"/>
                                    {{ $category->name }}
                                </div>
                            @elseif(session('applocale') == 'en')
                                <div v-on:click="childClick"  class="btn btn-primary btn-lg subCategory contentBox bookingOption childOf{{ $category->parent_category_id }} categoryId{{ $category->id }}">
                                    {{ $category->name }}
                                </div>

                            @elseif(session('applocale') == 'se')
                                <div v-on:click="childClick"  class="btn btn-primary btn-lg subCategory contentBox bookingOption childOf{{ $category->parent_category_id }} categoryId{{ $category->id }}">
                                    {{ $category->name_se }}
                                </div>

                            @elseif(session('applocale') == 'de')
                                <div v-on:click="childClick"  class="btn btn-primary btn-lg subCategory contentBox bookingOption childOf{{ $category->parent_category_id }} categoryId{{ $category->id }}">
                                    {{ $category->name_de }}
                                </div>
                            @endif
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
                                        {!! Form::text('startDate', null, array("id" => "startDate", 'v-model' => 'startDate', 'class' => 'form-control startDate', 'autocomplete' =>'off' ,'placeholder' => trans('booking/index.date'))) !!}
                                    </div>
                                    <!-- This is where we will fetch the color -->
                                    {{--<div class="form-group">
                                        {!! Form::text('durationDays', null, array('v-if' => 'timeType==1', 'v-model' => 'durationDays', 'class' => 'form-control', 'placeholder' => trans('booking/index.durationDays'))) !!}
                                    </div>--}}
                                    <div class="form-group">
                                        {!! Form::submit(trans('booking/index.searchButton'), array('class' => 'btn btn-success datesearch')) !!}
                                    </div>
                                    <div id="valid-errorr">Today is a holiday.<p> Please select another date and search again<p></div>
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
 <div style="display:none" id="tagfilter" v-show='tagfilter'  class="row">
   <div class="column">      
    {!! Form::label('tag_color', trans('Choose Filters')) !!}<br>
     {!! Form::label('tag_color', trans('Colors')) !!}
     {!! Form::select('tag_color[]', $array, 'default', array('id' => 'users_list', 'multiple'=>'', 'size'=>'5')); !!}
    
    </div>

    <div  class="column"><br>
     {!! Form::label('tag_size', trans('Size')) !!}
     {!! Form::select('tag_size[]', $arrayy, 'default', array('id' => 'users_listt', 'multiple'=>'', 'size'=>'5')); !!}
    
    </div>
</div>
        <div style="display:none" id="noResults" v-show='noResults'>
            <h3>{{ trans('booking/index.noResultsHeading') }}</h3>
            <p>{{ trans('booking/index.noResultsText') }}</p>
        </div>
        {{--***********************************   Search Results  ***********************************   --}}
        <div style="display:none" id="showResults" v-show='showResults'>
 {{--***********************************   Search Filters  ***********************************   --}}
  
   <div class="row">
   <div class="column">      
    {!! Form::label('tag_color', trans('Choose Filters')) !!}<br>
     {!! Form::label('tag_color', trans('Colors')) !!}
    <select name="tag_color" id="searchcolor" multiple="multiple" >
        @foreach($array as $val)
        <option @click="FilterColor({{$val}})"  value="{{$val}}">{{$val}}</option>
        @endforeach
    </select>

    </div>

    <div  class="column"><br>
     {!! Form::label('tag_size', trans('Size')) !!}
        <select name="tag_size" id="searchtag" multiple="multiple" >
            @foreach($arrayy as $val)
            <option @click="FilterSize({{$val}})"  value="{{$val}}">{{$val}}</option>
            @endforeach
        </select>
    
    </div>
</div>
  
            <div class="row">
                <div class="col-sm-2 contentBoxHolder">
                    <div class="contentBox bookingSection">
                        {{ trans('booking/index.productHeading') }}
                    </div>
                </div>
                <div class="col-sm-10 contentBoxHolder">
                    <div class="row">
                        <div class="col-sm-12 contentBoxHolder">
                            <div id="cartMessages">
                                <br/>
                                <div style="display:none" class="alert alert-success" role="alert">
                                    {{ trans('booking/index.addToCartSuccess') }}
                                </div>
                            </div>
                            <div id="productTable" class="contentBox">
                                <div class="row searchResult" v-for="result in results">
                                    <div class="col-sm-5">
                                        <div class="row">
                                            @if(session('applocale') == 'en')
                                                <div class="col-sm-12">
                                                    <h3>@{{ result.name }}</h3>
                                                    <h3>@{{ result.tag_color }}</h3>
                                                    <img v-if="result.product_images[0].image" src="/images/products/@{{ result.product_images[0].image }}"/>

                                                    <p v-if="Math.round(parseFloat(result.prices[2].pivot.price)) != 0 && (results[$index].price === undefined || results[$index].price == 0)">{{ trans('booking/index.costs') }} @{{ Math.round(parseFloat(result.prices[2].pivot.price)) }} {{ trans('booking/index.currency') }} {{ trans('booking/index.perDay') }}<br></p>

                                                    <br>
                                                    @{{ result.description }}<br>
                                                </div>
                                            @elseif(session('applocale') == 'de')
                                                <div class="col-sm-12">
                                                    <h3>@{{ result.name_de }}</h3>
                                                    <img v-if="result.product_images[0].image" src="/images/products/@{{ result.product_images[0].image }}"/>

                                                    <p v-if="Math.round(parseFloat(result.prices[2].pivot.price)) != 0 && (results[$index].price === undefined || results[$index].price == 0)">{{ trans('booking/index.costs') }} @{{ Math.round(parseFloat(result.prices[2].pivot.price)) }} {{ trans('booking/index.currency') }} {{ trans('booking/index.perDay') }}<br></p>

                                                    <br>
                                                    @{{ result.description_de }}<br>
                                                </div>
                                            @elseif(session('applocale') == 'se')
                                                <div class="col-sm-12">
                                                    <h3>@{{ result.name_se }}</h3>
                                                    <img v-if="result.product_images[0].image" src="/images/products/@{{ result.product_images[0].image }}"/>

                                                    <p v-if="Math.round(parseFloat(result.prices[2].pivot.price)) != 0 && (results[$index].price === undefined || results[$index].price == 0)">{{ trans('booking/index.costs') }} @{{ Math.round(parseFloat(result.prices[2].pivot.price)) }} {{ trans('booking/index.currency') }} {{ trans('booking/index.perDay') }}<br></p>

                                                    <br>
                                                    @{{ result.description_se }}<br>
                                                </div>
                                            @endif
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
                                            <!-- Modal -->
                                            <div class="modal fade in" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none; padding-right: 17px;">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLabel">{{trans('booking/index.bookingError')}}</h3>
                                                  </div>
                                                  <div class="modal-body">
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>

                                                <div class="col-sm-6 optionsColumn">
                                                    <div class="form-group" v-if="result.per_type_id == 1">
                                                        <label for="productTimeType">{{ trans('booking/index.durationType') }}:</label>
                                                        <select name="productTimeType" v-model='results[$index].productTimeType' class="form-control input selectBox productTimeType">
                                                            <option v-for="time in result.per_type_times_local" value="@{{ time.id }}">@{{ time.type_time_name }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group" v-if="result.per_type_id == 1 || result.per_type_id == 3">
                                                        <label for="startTime">{{ trans('booking/index.startTime') }}:</label>
                                                        
                                                        <select name="startTime" v-model='results[$index].startTime' class="form-control input selectBox" v-if="result.start_times.length > 1">
                                                            <option v-for="(timeIndex, time) in result.start_times">@{{ time.start_time }}</option>
                                                        </select>
                                                        <input type="text" name="startTime" class="form-control" readonly="readonly" value="@{{result.start_times[0].start_time}}" v-else>
                                                    </div>
                                          
                                                    <div class="row" v-if="result.number_of_persons == 'yes'">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="persons">{{ trans('booking/index.number_of_persons') }}:</label>
                                                                <input type="text" name="persons" v-model='results[$index].persons' class="form-control" placeholder="{{trans('booking/index.number_of_persons')}}">

                                                                {{--    <select name="quantity" v-model='results[$index].quantity' v-on:change="changeQuantity($index)" class="form-control input selectBox">
                                                                        <option v-for="(key, quantity) in result.quantityArray">@{{ quantity }}</option>
                                                                    </select>--}}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {!! Form::button('<span class="glyphicon glyphicon-refresh"></span>'.trans('booking/index.getPriceAvail'), array('class' => 'btn btn-default', 'v-on:click' => 'getPriceAvail($index, result)', 'id' => 'getPriceAvail@{{ $index }}', 'v-bind:disabled' => '!(result.per_type_id == "1" && result.quantity && (result.durationDays || result.durationHours)) && !(result.per_type_id == 3 && result.quantity)')) !!}
                                                        </div>
                                                    </div>

                                                </div>



                                                <input type="hidden" id="startTime" value="{{$klarnaDetails->startTime}}">
                                                     <input type="hidden" id="endTime" value="{{$klarnaDetails->endTime}}">
                                                     <input type="hidden" id="holiday" value="{{$klarnaDetails->holidays}}">
                                                <div class="col-sm-6 optionsColumn">
                                                    <div class="form-group "  v-if="result.per_type_id == 1">
                                                        <label for="durationDays">{{ trans('booking/index.theDuration') }}:</label>
                                                    
                                                         {!! Form::text('durationDays', null, array("autocomplete"=> "off",'onkeyup' => 'checkdurationhours(this)',/*'v-on:keyup' => 'keyupDurationDays($event, $index)', */'v-if' => 'parseInt(results[$index].productTimeType,10)==2', 'v-model' => 'results[$index].durationDays', 'class' => 'form-control howLong', 'placeholder' => trans('booking/index.durationDays'))) !!}
                                                        {!! Form::text('durationHours', null, array("autocomplete"=> "off",'onkeyup' => 'checkdurationhours(this)',/*'v-on:keyup' => 'keyupDurationHours($event, $index)',*/ 'v-if' => 'parseInt(results[$index].productTimeType,10)==1', 'v-model' => 'results[$index].durationHours', 'class' => 'form-control howLong', 'placeholder' => trans('booking/index.durationHours'))) !!}
                                                    </div>

                                                    {{--{{ Form::select(null, array("" => trans('booking/index.allTimeTypes'), '1' => trans('booking/index.wholeDay'), '2' => trans('booking/index.halfDay'), '3' => trans('booking/index.perHour')), 3, array("v-if" => "!timeType", 'v-model' => 'results[$index].productTimeType', 'class' => 'form-control input-lg')) }}<br>--}}
                                                    {{--<select v-model="results[$index].productTimeType" class="form-control input"><option value="" --}}{{--selected="selected"--}}{{-->All types</option><option value="1">Whole day</option><option value="2">Half day</option><option value="3">Per hour</option></select>--}}

                                                    <div class="form-group">
                                                        <label for="quantity">{{ trans('booking/index.quantity') }}:</label>
                                                        {!! Form::text('quantity', null, array("autocomplete"=> "off",'v-model' => 'results[$index].quantity', 'class' => 'form-control input quantity', 'placeholder' => trans('booking/index.quantity'))) !!}
                                                        {{-- <span class="text-success avlQuantity" style="display: inline;font-weight: bold;">{{trans('booking/index.Avilabel_quantity')}} @{{results[$index].original_quantity}}</span> --}}
                                                        <span class="text-success avlQuantity" style="display: inline;font-weight: bold;">{{trans('booking/index.Avilabel_quantity')}} @{{results[$index].updated_quantity}}</span>

                                                        {{--    <select name="quantity" v-model='results[$index].quantity' v-on:change="changeQuantity($index)" class="form-control input selectBox">
                                                                <option v-for="(key, quantity) in result.quantityArray">@{{ quantity }}</option>
                                                            </select>--}}
                                                    </div>


                                                    {{--{!! Form::button('<span class="glyphicon glyphicon-refresh"></span>'.trans('booking/index.getPriceAvail'), array('class' => 'btn btn-default', 'v-on:click' => 'getPriceAvail($index)', 'id' => 'getPriceAvail@{{ $index }}', 'v-bind:disabled' => '!results[$index].hasPriceAvailCriteria')) !!}--}}


                                                    

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {!! Form::button('<span class="glyphicon glyphicon-refresh"></span>'.trans('booking/index.addToBooking'), array('class' => 'btn btn-primary dynamic-button', 'v-on:click' => 'addToCart($index, result,\''.$klarnaDetails->startTime.'\',\''.$klarnaDetails->endTime.'\',\''.$klarnaDetails->holidays.'\')', 'id' => 'addToBookingButton@{{ $index }}', 'v-bind:disabled' => '!(result.per_type_id == "1" && result.quantity && (result.durationDays || result.durationHours)) && !(result.per_type_id == 3 && result.quantity)')) !!}
                                                        </div>
                                                        <div id="valid-error">Your booking starts or ends outside of opening hours.<p> Please check your settings and try again<p></div>
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
        <!-------- shopping cart   ----------->
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

        {!! Form::open(array('url' => 'booking/confirm', 'class' => "floatRight")) !!}
        {!! Form::hidden("bookingId" , null, array('v-model' => 'bookingId' )) !!}
        {!! Form::submit(trans('booking/index.continue'), $nextButtonArray) !!}
        {!! Form::close() !!}
        <br/><br/><br/><br/><br/>

        @if(sizeof($klarnaDetails->payment_methods) > 0)
            <div class="row" style="display:none" v-show='(shoppingCart.length > 0)'>
                <div class="col-sm-6 contentBoxHolder">
                    <img src="https://cdn.klarna.com/1.0/shared/image/generic/logo/sv_se/basic/blue-black.png?width=200">

                </div>
                <div class="col-sm-6 contentBoxHolder">
                    <div style="float:right;" class="klarna-widget klarna-badge-tooltip"
                         data-eid="{{$klarnaDetails->getKlarnaApiKey()}}"
                         data-locale="{{ $klarnaDetails->getCountryLanguageCode() }}"
                         data-badge-name="long-blue"
                         data-badge-width="385">
                    </div>
                </div>
            </div>
        @endif

        <div style="display:none" id="bookingId">@if($booking <> ""){{ $booking->id }}@endif</div>
        <div style="display:none" v-model="bookingToken" id="bookingToken">@if($booking <> ""){{ $booking->token }}@endif</div>

        <div style="display:none" id="deleteSureMessage">{{ trans('booking/index.deleteSureMessage') }}</div>

        {{-- <pre>
             @{{ $data | json }}
         </pre>--}}
        <div style="display:none" id="noZeroQuantity">{{ $javascriptMessages['noZeroQuantity'] }}</div>
        <div style="display:none" id="addToCartSuccess">{{ $javascriptMessages['addToCartSuccess'] }}</div>
        <div style="display:none" id="notEnough">{{ $javascriptMessages['notEnough'] }}</div>
        <div style="display:none" id="sameProductDateTimeError">{{ trans('errors/booking.sameProductDateTimeError') }}</div>
        <div style="display:none" id="maxDurationReached">{{ $javascriptMessages['maxDurationReached'] }}</div>

        @if(sizeof($klarnaDetails->payment_methods) > 0)
            <div class="row">
                {!! trans('booking/index.klarnaCookiePolicy') !!}
            </div>
        @endif
    </div>
@endsection
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@section("footerFirst")
    {{--<script async src="https://cdn.klarna.com/1.0/code/client/all.js"></script>--}}
@endsection

@section("footer")
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.2/i18n/jquery-ui-i18n.min.js"></script> -->

    <script type="text/javascript">
        

    

    

    </script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/i18n/datepicker.de-DE.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/i18n/datepicker.sv-SE.min.js"></script> -->
    <script src="/js/booking.js"></script>
    {{--<script src="jsTemp/booking.js"></script>--}}
    <script>
        $(document).ready(function(e) {
            var $input = $('#refresh');

            $input.val() == 'yes' ? location.reload(true) : $input.val('yes');

            /*$(window).bind("load", function() {
             alert('Page fully loaded');
             });*/

            // For Change Time Local
            // var siteLang = $(".getSiteLang").val()
            // if(siteLang == 'de'){
            //     $("#startDate").datepicker($.datepicker.regional['de']) 
            // }
            // else if(siteLang == 'en'){
            //     $("#startDate").datepicker($.datepicker.regional['en']) 
            // }
            // else if(siteLang == 'se'){
            //     $("#startDate").datepicker($.datepicker.regional['se']) 
            // }
           

        });
        
  
        var txt = 'Your booking starts or ends outside of opening hours. Please check your settings and try again';
        
        function checkdurationhours(e){
            var startDate = $('input[name="startDate"]').val();
            var startTime = $('select[name="startTime"]').val() ? $('select[name="startTime"]').val() : $('input[name="startTime"]').val();

            var srtTime = $('#startTime').val();
            var endTime = $('#endTime').val();
            var startDateTime = new Date(startDate+' '+startTime);
            var endDateTime =  new Date(startDate+' '+endTime);
            var holidays = $('#holiday').val().split(', ');
            var timeStops = getTimeStops(srtTime,endTime);
            
            var durType = $('select[name="productTimeType"]').val();
            if(durType == 1){
            
                var durationTime = moment(startTime,'H:mm').add(e.value,'hour').format();
                var durationDateTime = new Date(durationTime);

                if(endDateTime >= durationDateTime){
                    $('#addToBookingButton0').prop("disabled", false);
                }else{
                    durDate = durationDateTime.getDate();
                    durMonth = durationDateTime.getMonth() + 1;
                    durYear = durationDateTime.getFullYear();
                    durHour    = durationDateTime.getHours();
                    durMinute  = durationDateTime.getMinutes();
                    

                    if(durDate.toString().length == 1) {
                        durDate = '0'+durDate;
                    }  
                    if(durHour.toString().length == 1) {
                         durHour = '0'+durHour;
                    }
                    if(durMinute.toString().length == 1) {
                         durMinute = '0'+durMinute;
                    }
                    checkDate = durYear+'/'+durMonth+'/'+durDate;
                   
                    // console.log(holidays.indexOf(checkDate))
                    if(holidays.indexOf(checkDate) > -1){
                        // alert("hi")
                        $('#valid-error').show();
                        $('#addToBookingButton0').prop("disabled", true);
                        //checkHours(timeStops,durHour,durMinute);      

                    }else{
                        // alert("hello12345")
                    $('#valid-error').hide();
                    $('#addToBookingButton0').prop("disabled", false);
                        checkHours(timeStops,durHour,durMinute);
                    }

                
                    
                }
            }else{
            
                var durationTime = moment(startDate, "YYYY-MM-DD").add('days', e.value);
                var durationDateTime = new Date(durationTime);
                    durDate = durationDateTime.getDate();
                    durMonth = durationDateTime.getMonth() + 1;
                    durYear = durationDateTime.getFullYear();
                    if(durDate.toString().length == 1) {
                        durDate = '0'+durDate;
                    }  
                    checkDate = durYear+'/'+durMonth+'/'+durDate;

                    if(holidays.indexOf(checkDate) > -1){
                         $('#valid-error').show();
                        $('#addToBookingButton0').prop("disabled", true);

                    }else{
                        $('#valid-error').hide();
                    $('#addToBookingButton0').prop("disabled", false);
                    }
            }
            
            
            
        }
        
        
        function checkHours(time,hour,min){
            // console.log(time)
            // alert(hour)
            // alert(min)
            // console.log(time.indexOf(hour+':'+min))
            if(time.indexOf(hour+':'+min) > -1){
                $('#valid-error').hide();
                $('#addToBookingButton0').prop("disabled", false);  
            }else{
                $('#valid-error').show();
                $('#addToBookingButton0').prop("disabled", true);
            }
        }
        function getTimeStops(start, end){
          var startTime = moment(start, 'HH:mm');
          var endTime = moment(end, 'HH:mm');
          
          if( endTime.isBefore(startTime) ){
            endTime.add(1, 'day');
          }

          var timeStops = [];

          while(startTime <= endTime){
            timeStops.push(new moment(startTime).format('HH:mm'));
            startTime.add(5, 'minutes');
          }
          return timeStops;
        }

        // for Display Avilabel Quantity
        $(document).on('change' ,".productTimeType" ,function(){
            var productType = $(this).val()
            if(productType == '1'){
                $(".avlQuantity").css('display' ,'none')
            }
            else if(productType == '2'){
                $('.avlQuantity').css('display' ,'inline')
            }
        })

        $(document).on('click' ,'.closeModal' ,function(){
            $("#exampleModal").css("display" ,"none")
        })
    </script>
    {{--@if(sizeof($klarnaDetails->payment_methods) > 0)
        <script async src="https://cdn.klarna.com/1.0/code/client/all.js"></script>
    @endif--}}
@endsection
