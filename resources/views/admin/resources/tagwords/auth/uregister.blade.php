@extends('appm')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Registration</div>
                <div class="panel-body">
                    <p>{{trans('booking/confirm.intro')}}</p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        @if(Session::has('centreId'))
                            <h1 style="margin: 30px 0">{{ Session::get('centreName') }}</h1>
                            <input value="{{ Session::get('centreId') }}" type="hidden" name="centreId"/>
                            <input value="manager" type="hidden" name="usertype"/>
                        @endif
                       
                      <input class="form-control" value="front_end" name="usertype" id="usertype" type="hidden" />

                            <div class="form-group">
                                @if ($errors->has('name'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                     </span>
                                @endif
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="{{trans('booking/confirm.name')}}"/>
                            </div>
                            <div class="form-group">
                                 @if ($errors->has('address'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('address') }}</strong>
                                     </span>
                                @endif
                                <label for="address"><i class="zmdi zmdi-pin material-icons-name"></i></label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="{{trans('booking/confirm.address')}}"/>
                            </div>
                            <div class="form-group">
                                @if ($errors->has('zipcode'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('zipcode') }}</strong>
                                     </span>
                                @endif
                                <label for="zipcode"><i class="zmdi zmdi-pin material-icons-name"></i></label>
                                <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="{{trans('booking/confirm.postCode')}}"/>
                            </div>
                            <div class="form-group">
                                @if ($errors->has('city'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('city') }}</strong>
                                     </span>
                                @endif
                                <label for="city"><i class="zmdi zmdi-pin material-icons-name"></i></label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="{{trans('booking/confirm.city')}}"/>
                            </div>
                            <div class="form-group">
                                @if ($errors->has('country'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('country') }}</strong>
                                     </span>
                                @endif
                                <label for="countries"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <select id="country" name="country" class="form-control">
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
                            </div>
                            <div class="form-group">
                                
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                 @if(Session::has('email'))
                                    <label for="email"><i class="zmdi zmdi-email"></i></label>
                                    <input class="form-control" readonly="readonly" value="{{ Session::get('email') }}" id="email"  name="email"/>
                                @else
                                <input type="email" class="form-control" name="email" id="email" placeholder="{{trans('booking/confirm.email')}}"/>
                                @endif
                            </div>
                            <div id="status"></div>
                            <div class="form-group">
                                 @if ($errors->has('password'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                     </span>
                                @endif
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="{{trans('booking/confirm.password')}}"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" class="form-control" name="password_confirmation" id="re_pass" placeholder="{{trans('booking/confirm.confirmpass')}}"/>
                            </div>
                             @if ($errors->has('email'))
                                     <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                     </span>
                                @endif
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>{{ trans('auth/register.createAccount') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function(){
            $("#re_pass").keyup(function(){
                 if ($("#password").val() != $("#re_pass").val()) {
                     $("#status").html("Password do not match").css("color","red");
                     $("#submit").prop('disabled',true);
                 }else{
                     $("#status").html("Password matched").css("color","green");
                     $("#submit").prop('disabled',false);
                }
          });
    });
    </script>
@endsection
