@extends('app')

@section('content')



<style>
    #confirmNavBox {
        margin-top: 200px;
    }

    .floatRight {
        margin: 30px;
        float: right;
    }

    .previous {
        margin: 30px 30px 30px 0;
        float: left;
    }

    .cartRow {
        margin-top: 40px;
    }
	.checkout-errormsg{
		color:red;
	}
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
</style>
<script>
    function removeCartItem (bookingLocationId)
        {
            //jpf
            if (confirm($('#deleteSureMessage').html()))
            {
                var that = this;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/api/booking/removeCartItem",
                    data: {
                        bookingLocationId
                    },
                    success: function (success) {

                        if (parseInt(success, 10) === 1)
                        {
                            alert('Item successfully deleted');
                            //that.removeCartItemFromCart(bookingLocationId);

                        }
                        else
                        {
                            alert('there was an error removing booking locationid '+bookingLocationId);
                        }

                    },
                    error: function(error) {
                        debugger
                    },
                    dataType: "text"
                });
            }
            else
            {
                return false;
            }
            return false;
        };
		
		
</script>
<div class="row">
    <div class="col-xs-12 {{-- col-sm6-4 col-md-4 --}} contentBoxHolder">
        <div class="contentBox">
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
	
	<p>Opening Hours : <?php 
	$date = new DateTime($klarnaDetails->startTime.' 06/13/2013');
	echo $date->format('h:i A') ; ?></p>
    <p>Closing Hours : <?php 
	$date = new DateTime($klarnaDetails->endTime.' 06/13/2013');
	echo $date->format('h:i A') ; ?></p>
	</div>
            @include("partials.bookingBreadcrumbs")
            <div class="row">
                <div class="col-sm-10">
                    {!! Form::open(array('url' => '/booking/pay', "id" => "confirmForm")) !!}
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <h3>{{ trans('booking/confirm.heading') }}</h3>
                    <div class="form-group">
                        
                        @if(Session::has('name'))
                            <label for="name">{{trans('booking/confirm.name')}}<i class="zmdi zmdi-name"></i></label>
                            <input class="form-control"  value="{{ Session::get('name') }}" id="name"  name="name"/>
                        @else
                       {!! Form::text('name', $booking->name ? $booking->name : (Auth::check() ?
                        Auth::user()->centres->first()->name : ""), array('class' => 'form-control', 'placeholder' =>
                        trans('booking/confirm.name'))) !!}
                        <!--<input type="text" class="form-control" name="address" id="address" placeholder="{{trans('booking/confirm.address')}}"/>-->
                        @endif
                    </div>
                    @if(true || !$centre->klarna_only)
                    {!! Form::hidden('takeCustomerDetails', true) !!}
                    
                    
                    <div class="form-group">
                        @if(Session::has('address'))
                            <label for="address">{{trans('booking/confirm.address')}}<i class="zmdi zmdi-address"></i></label>
                            <input class="form-control"  value="{{ Session::get('address') }}" id="address"  name="address"/>
                        @else
                        {!! Form::text('address', $booking->address ? $booking->address : (Auth::check() ?
                        Auth::user()->centres->first()->address1 : ""), array('class' => 'form-control', 'placeholder'
                        => trans('booking/confirm.address'))) !!}
                        <!--<input type="text" class="form-control" name="address" id="address" placeholder="{{trans('booking/confirm.address')}}"/>-->
                        @endif
                    </div>
                    <div class="form-group">
                        @if(Session::has('zipcode'))
                            <label for="post_code">{{trans('booking/confirm.postCode')}}<i class="zmdi zmdi-post_code"></i></label>
                            <input class="form-control"  value="{{ Session::get('zipcode') }}" id="postCode"  name="postCode"/>
                        @else
                         {!! Form::text('postCode', $booking->post_code ? $booking->post_code : (Auth::check() ?
                        Auth::user()->centres->first()->post_code : ""), array('class' => 'form-control', 'placeholder'
                        => trans('booking/confirm.postCode'))) !!}
                        <!--<input type="text" class="form-control" name="post_code" id="post_code" placeholder="{{trans('booking/confirm.postCode')}}"/>-->
                        @endif
                    </div>
                    <div class="form-group">
                        @if(Session::has('city'))
                            <label for="city">{{trans('booking/confirm.city')}}<i class="zmdi zmdi-city"></i></label>
                            <input class="form-control"  value="{{ Session::get('city') }}" id="city"  name="city"/>
                        @else
                        {!! Form::text('city', $booking->city ? $booking->city : (Auth::check() ?
                        Auth::user()->centres->first()->city : ""), array('class' => 'form-control', 'placeholder' =>
                        trans('booking/confirm.city'))) !!}
                        <!--<input type="text" class="form-control" name="city" id="city" placeholder="{{trans('booking/confirm.city')}}"/>-->
                        @endif
                    </div>
					<div class="form-group">
					    @if(Session::has('country'))
                            <label for="country">{{trans('Country')}}<i class="zmdi zmdi-country"></i></label>
                            <!--<input class="form-control"  value="{{ Session::get('country') }}" id="bookingcountry"  name="bookingcountry"/>-->
                            <select name="bookingcountry" class="form-control">
									<option value="" selected="">
									  - Choose - </option>
									<option value="AT">
									  Austria </option>
									<option value="BE">
									  Belgium </option>
									<option value="BG">
									  Bulgaria </option>
									<option value="HR">
									  Croatia </option>
									<option value="CY">
									  Cyprus </option>
									<option value="CZ">
									  Czech Republic </option>
									<option value="DK">
									  Denmark </option>
									<option value="EE">
									  Estonia </option>
									<option value="FI">
									  Finland </option>
									<option value="FR">
									  France </option>
									<option value="DE">
									  Germany </option>
									<option value="GR">
									  Greece </option>
									<option value="HU">
									  Hungary </option>
									<option value="IE">
									  Ireland </option>
									<option value="IT">
									  Italy </option>
									<option value="LV">
									  Latvia </option>
									<option value="LT">
									  Lithuania </option>
									<option value="LU">
									  Luxembourg </option>
									<option value="MT">
									  Malta </option>
									<option value="NL">
									  Netherlands </option>
									<option value="NO">
									  Norway </option>
									<option value="PL">
									  Poland </option>
									<option value="PT">
									  Portugal </option>
									<option value="RO">
									  Romania </option>
									<option value="SK">
									  Slovakia </option>
									<option value="SI">
									  Slovenia </option>
									<option value="ES">
									  Spain </option>
									<option value="SE" selected>
									  Sweden </option>
									<option value="GB">
									  United Kingdom </option>
									<option value="US">
									  USA </option>
								  </select>
                        @else
                        	<select name="bookingcountry" class="form-control">
									<option value="" selected="">
									  - Choose - </option>
									<option value="AT">
									  Austria </option>
									<option value="BE">
									  Belgium </option>
									<option value="BG">
									  Bulgaria </option>
									<option value="HR">
									  Croatia </option>
									<option value="CY">
									  Cyprus </option>
									<option value="CZ">
									  Czech Republic </option>
									<option value="DK">
									  Denmark </option>
									<option value="EE">
									  Estonia </option>
									<option value="FI">
									  Finland </option>
									<option value="FR">
									  France </option>
									<option value="DE">
									  Germany </option>
									<option value="GR">
									  Greece </option>
									<option value="HU">
									  Hungary </option>
									<option value="IE">
									  Ireland </option>
									<option value="IT">
									  Italy </option>
									<option value="LV">
									  Latvia </option>
									<option value="LT">
									  Lithuania </option>
									<option value="LU">
									  Luxembourg </option>
									<option value="MT">
									  Malta </option>
									<option value="NL">
									  Netherlands </option>
									<option value="NO">
									  Norway </option>
									<option value="PL">
									  Poland </option>
									<option value="PT">
									  Portugal </option>
									<option value="RO">
									  Romania </option>
									<option value="SK">
									  Slovakia </option>
									<option value="SI">
									  Slovenia </option>
									<option value="ES">
									  Spain </option>
									<option value="SE" selected>
									  Sweden </option>
									<option value="GB">
									  United Kingdom </option>
									<option value="US">
									  USA </option>
								  </select>
                        @endif
					
					</div>
					
                    <div class="form-group">
                        
                    </div>
                    <div class="form-group">
                        @if(Session::has('email'))
                            <label for="email">{{trans('booking/confirm.email')}}<i class="zmdi zmdi-city"></i></label>
                            <input class="form-control"  value="{{ Session::get('email') }}" id="email"  name="email"/>
                        @else
                         {!! Form::text('email', $booking->email ? $booking->email : (Auth::check() ? Auth::user()->email
                        : ""), array('class' => 'form-control', 'placeholder' => trans('booking/confirm.email'))) !!}
                        <!--<input type="text" class="form-control" name="email" id="email" placeholder="{{trans('booking/confirm.email')}}"/>-->
                        @endif
                    </div>
                    <div class="form-group">
                    </div>
                    @endif

                    {{--{!! Form::hidden('terms_accepted', true) !!}--}}

                    {!! Form::hidden("bookingId", $booking->id) !!}

                    {{--@include('partials/selectedProducts')--}}
                    @if($centre->useAdminFee)

                    {!! Form::hidden("usingAdminFee", "1") !!}
                    {!! Form::hidden("adminFee", $centre->adminFee) !!}

                    <h3>{{ trans('booking/index.adminFeeHeading') }}</h3>
                    <p>{{ $adminFeeExplanation }}</p>
                    <p>{{ trans('booking/index.adminFeePrice1') }} {{ $centre->adminFee }} kr
                        {{ trans('booking/index.adminFeePrice2') }}</p>
                    {{--{{ $centre->adminFee }}--}}

                    {!! Form::label("quantityAdminFee", trans('booking/index.adminFeeLabel')) !!}
                    {!! Form::text('quantityAdminFee', $quantityAdminFeeQuantity, array('class' => 'form-control',
                    'placeholder' => trans('booking/index.adminFeeLabel'))) !!}
                    @else
                    {!! Form::hidden("usingAdminFee", "0") !!}
                    @endif
                    <br /><br />
                    <h3>{{ trans('booking/confirm.ContentBooking') }}</h3>

                    {!! Form::close() !!}

                </div>
                <div class="col-sm-2">
                    <div class="contentBox">
                        <h4 v-show="afterInitialLoad" class="afterInitialLoad" style="display:none">
                            {{ trans('booking/index.totalPrice') }}:</h4>
                        <h2 v-show="afterInitialLoad" class="afterInitialLoad" style="display:none">{{ $totalPrice }} kr
                        </h2>
                        <h4 v-show="afterInitialLoad" class="afterInitialLoad" style="display:none">
                            {{ trans('booking/index.totalReservationPrice') }}:</h4>
                        <h2 v-show="afterInitialLoad" class="afterInitialLoad" style="display:none">{{ $totalReservationPrice }} kr
                        </h2>
                        @if($centre->bookingFee > 0)
                        <h4 v-show="afterInitialLoad" class="afterInitialLoad" style="display:none">
                            {{ trans('booking/index.bookingFee') }} {{ $centre->bookingFee }} kr</h4>
                        @endif
                        <br />
                        <br />
                        @if(isset($booking->id))
                        <div>
                            {!! Form::open(array('url' => '/booking/empty-cart', 'method' => 'post', 'class' =>
                            'emptyCartLink')) !!}
                            {!! Form::hidden('bookingId', $booking->id) !!}
                            {!! Form::submit(trans('booking/index.cartEmpty'), array('class' => 'btn btn-warning')) !!}
                            {!! Form::close() !!}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="shoppingCart" class="row">
                <div class="col-sm-12 contentBoxHolder">
                    @foreach($booking->products as $product )
                    <div class="row cartRow" v-for="item in shoppingCart">
                        <div class="col-sm-5">

                            @if (!isset($confirmPage) AND $product->getPrimaryImage() <> "")
                                <img style="float: left;margin-right: 12px;width:200px" v-if="item.image"
                                    src="/images/products/{{$product->getPrimaryImage()}}" /><br>
                                @endif

                                <h3 class="shoppingCartProductHeading">{{ $product->name }}
                                    ({{ round($product->pivot->quantity) }} {{ trans('booking/index.pieces') }})</h3>

                        </div>
                        <div class="col-sm-5">
                            <div class="row">
                                <div class="col-sm-4 cartLabel">
                                    {{ trans('booking/index.cartCategory') }}:
                                </div>
                                <div class="col-sm-8">
                                    {{ $product->category->name }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 cartLabel">
                                    {{ trans('booking/index.cartName') }}:
                                </div>
                                <div class="col-sm-8">
                                    {{ $product->name }}
                                </div>
                            </div>

                            <div v-if="(item.quantity > 0)" class="row">
                                <div class="col-sm-4 cartLabel">
                                    {{ trans('booking/index.cartQuantity') }}:
                                </div>
                                <div class="col-sm-8">
                                    {{ round($product->pivot->quantity) }} {{ trans('booking/index.pieces') }}
                                </div>
                            </div>
                            @if(!$product->isFee())
                            <div class="row">
                                <div class="col-sm-4 cartLabel">
                                    {{ trans('booking/index.cartDate') }}:
                                </div>
                                <div class="col-sm-8">
                                    {{ substr($product->pivot->startDateTime, 0, 10) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 cartLabel">
                                    {{ trans('booking/index.cartStartTime') }}:
                                </div>
                                <div class="col-sm-8">
                                    {{ substr($product->pivot->startDateTime, 10, 6) }}
                                </div>
                            </div>

                            {{--<div class="row" v-show="item.productTimeType == 2 || item.productTimeType == 1" >
                                        <div class="col-sm-4 cartLabel">
                                            {{ trans('booking/index.cartDuration') }}:
                        </div>
                        <div class="col-sm-8">
                            <span v-show="item.productTimeType == 2">
                                @{{ item.durationDays }} {{ trans('booking/index.days') }}
                            </span>
                            <span v-show="item.productTimeType == 1">
                                @{{ item.durationHours }} {{ trans('booking/index.hours') }}
                            </span>

                        </div>
                    </div>--}}
                    @endif

                    <div class="row">
                        <div class="col-sm-4 cartLabel">
                            {{ trans('booking/index.cartPrice') }}:
                        </div>
                        <div class="col-sm-8">
                            {{ $product->pivot->price }} {{ trans('booking/index.currency') }}
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-4 cartLabel">
                            {{ trans('booking/index.reservepercentage') }}:
                        </div>
                        <div class="col-sm-8">
                            {{ round($product->reservepercentage*$product->pivot->price/100) }} {{ trans('booking/index.currency') }}
                         </div>
                    </div>

                </div>
                <div class="col-sm-2">
                    {!! Form::open(array($removeProductEvent => 'removeCartItem('.$product->pivot->id.')')) !!}

                    {!! Form::hidden('bookingId', $product->pivot->booking_id) !!}
                    {!! Form::submit(trans('booking/index.delete'), array('class' => 'btn btn-warning')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{--                <div class="row">
                    <div class="col-sm-12 contentBoxHolder">
                        <h3>{{ trans('booking/confirm.rule') }}EEE</h3>
    <p>
        {{ $bookingConditions }}
    </p>
</div>
</div>
--}}
<div style="display:none" id="deleteSureMessage">{{ trans('booking/index.deleteSureMessage') }}</div>

@if (!Auth::user())
<div class="row">
    <div class="col-sm-12 contentBoxHolder">
        <h3>{{ trans('booking/confirm.policy') }}</h3>
        <p>
            {{ $payment_policy }}
        </p>
    </div>
</div>

<div class="form-group">
    <label for="terms_accepted">
        {!! Form::checkbox('terms_accepted', $booking->terms_accepted, $booking->terms_accepted, [ 'id'=>
        'cancellationTerms']) !!} {{ trans('booking/pay.cancellation') }}
    </label>
</div>

<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false"
    aria-controls="collapseExample">
    {{ trans('booking/confirm.rule') }}
</a>

<div class="collapse" id="collapseExample">
    <div class="well">
        {!! nl2br($bookingConditions) !!}
    </div>
</div>
@else
<br><br>
<div class="form-group">
    <label for="terms_accepted">
        {!! Form::checkbox('terms_accepted', $booking->terms_accepted, $booking->terms_accepted, [ 'id'=>
        'cancellationTerms']) !!} {{ trans('booking/pay.adminCancellation') }}
    </label>
</div>
@endif


{!! Form::close() !!}
<div class="row">
    <div class="col-sm-6 contentBoxHolder">
        {!! Form::open(array('url' => '/booking', 'method' => 'get', 'class' => 'previous')) !!}
        {!! Form::hidden('bookingId', $booking->id) !!}
        {!! Form::submit(trans('booking/confirm.previous'), array('class' => 'btn btn-default')) !!}
        {!! Form::close() !!}
    </div>
    <div class="col-sm-6 contentBoxHolder">
        <div class="row">
            <div class="col-sm-12">
			   <div class="checkout-errormsg" id="checkout-errormsg">

              </div>
                @if (/*Auth::guest()*/Auth::user() && $usertype == 6)
                {!! Form::submit(trans('booking/confirm.saveBookingButton'), array('class' => 'btn btn-primary
                floatRight', 'id'=>'confirmButton')) !!}
                @elseif (/*Auth::guest()*/Auth::user() && $usertype == 1)
                {!! Form::submit(trans('booking/confirm.saveBookingButton'), array('class' => 'btn btn-primary
                floatRight', 'id'=>'confirmButton')) !!}
                @elseif (/*Auth::guest()*/Auth::user() && $usertype == 9)
               
                {!! Form::submit(trans('booking/confirm.confirmButton'), array('class' => 'btn btn-primary floatRight',
                'id'=>'confirmButton')) !!}
                @else
                {!! Form::submit(trans('booking/confirm.confirmButton'), array('class' => 'btn btn-primary floatRight',
                'id'=>'confirmButton')) !!}
                @endif
            </div>
        </div>
        {{--
                        <div class="row">
                            <p style="float:right;margin-right:45px;">
                                {{ trans('booking/pay.byClickingAgreeCancellation') }}
        </p>
    </div>
    --}}
</div>
</div>


</div>
</div>
</div>

@endsection

@section("footer")
<script>
    $(document).ready(function() {
		
            $("#confirmButton").prop('disabled', true);
            $("#confirmButton").click(function () {
					const errmsg = document.querySelector('.checkout-errormsg');
				  	const form = document.getElementById('confirmForm'),
					email = document.querySelector('input[name="email"]').value,
					shipping_country = form.querySelector('select[name="bookingcountry"]').value,
					firstname = form.querySelector('input[name="name"]').value,
					lastname = '',
					postal_code = form.querySelector('input[name="postCode"]').value,
					locality = form.querySelector('input[name="city"]').value,
					address1 = document.querySelector('input[name="address"]').value,
					address2 = '',
					name = firstname;
				  errmsg.textContent = "";
				  if(!email){
					errmsg.textContent = "Please enter the Email ID";
					return false;
				  } else if(!shipping_country){
					errmsg.textContent = "Please select the Shipping To";
					return false;
				  } else if(!firstname){
					errmsg.textContent = "Please enter the First Name";
					return false;
				  } else if(!postal_code){
					errmsg.textContent = "Please enter the Postal Code";
					return false;
				  } else if(!locality){
					errmsg.textContent = "Please enter the Locality";
					return false;
				  }
				
				
				
                $("#confirmForm").submit();
            });

            $("input[name='terms_accepted']").click(function (evt) {
			
                if ($(evt.target).is(":checked")) {
                    //$("#confirmButton").prop('disabled', function(i, v) { return !v; });
                    $("#confirmButton").prop('disabled', false);
                }
                else {
                    $("#confirmButton").prop('disabled', true);
                }
            });

            $('.afterInitialLoad').show();

            /*if (!$("input[name='terms_accepted']").is(':checked')) {

                $("#confirmButton").prop('disabled', true);
            }*/
        });
</script>


@endsection