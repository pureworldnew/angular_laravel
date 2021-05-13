@extends('app')

@section('content')
   <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div class="contentBox">

                {!! Form::open(['method' => 'post', 'url' => 'admin/users/invite', 'class' => 'form-horizontal form-inline']) !!}

                    <h2>{{ trans('booking/users.heading') }}</h2>
                    <p>{{ trans('booking/users.description') }}</p>
                    @if(Session::has('flashMessage'))
                        <p style="color:blue;font-weight: 1.3em;">{{ Session::get('flashMessage') }}</p>
                    @endif
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">

                                <label for="email"></label>
                                {!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => trans('booking/users.enterEmail'))) !!}

                            </div>
                        </div><br>
                        <div class="col-sm-12">
                            <div class="form-group">

                                <label for="status"></label>
                                 @if (/*Auth::guest()*/Auth::user() && $user_type == 1)
                                <select class="form-control" name="status" id="status">
                                  <option value="admin">{{ trans('booking/users.admininvite') }}</option>
                                  <option value="manager">{{ trans('booking/users.ManagerInvite') }}</option>
                                  <option value="frontend">{{ trans('booking/users.frontEnd') }}</option>
                                </select>
                                @else
                                <select class="form-control" name="status" id="status">
                                  <option value="frontend">{{ trans('booking/users.frontEnd') }}</option>
                                </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::submit(trans('booking/users.sendInvitation'), array('class' => 'btn btn-success')) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
