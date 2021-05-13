@extends('app')

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        } .floatRight {
              margin: 30px;
              float:right;
          }
        .previous {
            margin: 30px 30px  30px 0;
            float: left;
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
                @include("partials.bookingBreadcrumbs")

                {!! Form::open(array('url' => '/booking/pay', "id" => "confirmForm")) !!}
                    <h3>{{ trans('booking/confirm.heading') }}</h3>
                    <div class="form-group">
                        {!! Form::text('name', $booking->name ? $booking->name : "", array('class' => 'form-control', 'placeholder' => trans('booking/confirm.name'))) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('address', $booking->address ? $booking->address : "", array('class' => 'form-control', 'placeholder' => trans('booking/confirm.address'))) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('city', $booking->city ? $booking->city : "", array('class' => 'form-control', 'placeholder' => trans('booking/confirm.city'))) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('postCode', $booking->post_code ? $booking->post_code : "", array('class' => 'form-control', 'placeholder' => trans('booking/confirm.postCode'))) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('telephone', $booking->telephone ? $booking->telephone : "", array('class' => 'form-control', 'placeholder' => trans('booking/confirm.telephone'))) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('email', $booking->email ? $booking->email : "", array('class' => 'form-control', 'placeholder' => trans('booking/confirm.email'))) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('freeText', $booking->freeText ? $booking->freeText : "", array('class' => 'form-control', 'placeholder' => trans('booking/confirm.freeText'))) !!}
                    </div>
                    {!! Form::hidden("bookingId", $booking->id) !!}

                    <h3>{{ trans('booking/confirm.ContentBooking') }}</h3>
                    {{--@include('partials/selectedProducts')--}}
                {!! Form::close() !!}

                    <table class="table table-striped">
                        <?php $confirmPage = true;?>
                        @include('partials/productsInCart')
                        {{--@foreach($booking->products as $product )
                            <tr>
                                <td>
                                    {{ $product->name }}, {{ $product->quantity }}, st {{ $product->startDateTime }}, --}}{{--3   item.duration }}--}}{{-- kostnad {{ $product->pivot->price }} SEK<br/>
                                    <b>Date:</b> {{ $product->pivot->startDateTime }}
                                </td>
                                <td>{!! Form::open(array('url' => '/booking', "@submit.prevent" => "editItem(item.productId)")) !!}
                                    {!! Form::submit(trans('booking/confirm.delete'), array('class' => 'btn btn-warning')) !!}
                                    {!! Form::close() !!}</td>
                            </tr>
                        @endforeach--}}
                    </table>


                    <h3>{{ trans('booking/confirm.rule') }}</h3>
                    <p>
                        {{ $bookingConditions }}
                    </p>

                    <h3>{{ trans('booking/confirm.policy') }}</h3>
                    <p>
                        {{ $payment_policy }}
                    </p>

                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox" id="cancellationTerms" > {{ trans('booking/pay.cancellation') }}
                        </label>
                    </div>
                    <div style="display:none" id="deleteSureMessage">{{ trans('booking/index.deleteSureMessage') }}</div>

                    {!! Form::close() !!}
                    <div>

                        {!! Form::submit(trans('booking/confirm.confirmButton'), array('class' => 'btn btn-primary floatRight', 'id'=>'confirmButton', 'disabled' => 'true')) !!}
                        {!! Form::open(array('url' => '/booking', 'method' => 'get', 'class' => 'previous')) !!}
                            {!! Form::hidden('bookingId', $booking->id) !!}
                            {!! Form::submit(trans('booking/confirm.previous'), array('class' => 'btn btn-default')) !!}
                        {!! Form::close() !!}
                    </div>


            </div>
        </div>
    </div>

@endsection

@section("footer")
    <script>
        $(document).ready(function() {
            $("#confirmButton").click(function() {
                $("#confirmForm").submit();
            });

            $("#cancellationTerms").click(function(){
                $("#confirmButton").prop('disabled', function(i, v) { return !v; });
            });


        });
    </script>
@endsection
