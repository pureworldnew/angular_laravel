@extends('appm')

@section('content')
<style>
.button {
    display: block;
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
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> 
                <!-- use the shop id here-->
                        {!! $sessionMessage !!}
                </div>
                <div class="panel-body">
                    <p>{{trans('Profile')}}</p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/EditProfile') }}">
                        {!! csrf_field() !!}
                         <h4 style="margin: 15px 0; color:green">You registered successfully for {{$store->name}}</h4>
                           
                      <input class="form-control" value="front_end" name="usertype" id="usertype" type="hidden" />
                      <input class="form-control" value="front_end" name="centreId" id="centreId" type="hidden" />
       
                            <div class="form-group">
                                @if ($errors->has('name'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                     </span>
                                @endif
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input class="form-control" type="text" name="name" id="name" value="{{$profile->name}}"/>
                            </div>
                            <div class="form-group">
                                 @if ($errors->has('address'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('address') }}</strong>
                                     </span>
                                @endif
                                <label for="address"><i class="zmdi zmdi-pin material-icons-name"></i></label>
                                <input type="text" class="form-control" name="address" id="address" value="{{$profile->address}}"/>
                            </div>
                            <div class="form-group">
                                @if ($errors->has('zipcode'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('zipcode') }}</strong>
                                     </span>
                                @endif
                                <label for="zipcode"><i class="zmdi zmdi-pin material-icons-name"></i></label>
                                <input type="text" class="form-control" name="zipcode" id="zipcode" value="{{$profile->zipcode}}"/>
                            </div>
                            <div class="form-group">
                                @if ($errors->has('city'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('city') }}</strong>
                                     </span>
                                @endif
                                <label for="city"><i class="zmdi zmdi-pin material-icons-name"></i></label>
                                <input type="text" class="form-control" name="city" id="city" value="{{$profile->city}}"/>
                            </div>
                            <div class="form-group">
                                @if ($errors->has('country'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('country') }}</strong>
                                     </span>
                                @endif
                                <label for="countries"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <select id="country" name="country" class="form-control">
                                    <option value="{{$profile->country}}">{{$profile->country}}</option>
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
									<option value="SE">
									  Sweden </option>
									<option value="GB">
									  United Kingdom </option>
									<option value="US">
									  USA </option>
                                </select>
                            </div>
                            <div class="form-group">
                                
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" class="form-control" name="email" id="email" value="{{$profile->email}}" />
                            </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>{{ trans('Update') }}
                                </button>
                            </div>
                        </div>
                         @if ($errors->has('error'))
                                <div class="col-md-12 col-sm-12 col-lg-12 login-right alert alert-danger"  id="login-error">
                                    <strong>{{ $errors->first('error') }}</strong>
                                </div>
                                @endif
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection
