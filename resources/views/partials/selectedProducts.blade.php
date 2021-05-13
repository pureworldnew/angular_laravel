<style>
    .shoppingCartTable td.firstCol {
        font-weight:bold;
    }

    @media (min-width: 768px) {
        .cartLabel {
            text-align: right;
        }
        .removeButton {
            margin-top: 40%;
        }
    }
    @media (max-width: 767px) {
        .inCartRow
        {
            margin-bottom: 15px;
        }
    }
    .cartLabel {
        font-weight:bold;

    }
    .cartRow {
        border-bottom: 1px solid #eee;
        padding: 1% 0;
    }
</style>
<div id="shoppingCart" class="row">
    <div class="col-sm-12 contentBoxHolder">
        <div class="row cartRow" v-for="item in shoppingCart" v-if="item.category_name != 'Fees'">
            <div class="col-sm-5">
                <img style="float: left;margin-right: 12px;" v-if="item.image" src="/images/products/@{{ item.image }}"/><br>
                <h3 v-if="(item.quantity == 0)" class="shoppingCartProductHeading">@{{ item.name }}asdf</h3>
                <h3 v-if="(item.quantity > 0)" class="shoppingCartProductHeading">@{{ item.name }} (@{{ Math.round(item.quantity) }} {{ trans('booking/index.pieces') }})</h3>

            </div>
            <div class="col-sm-5">
                <div class="row inCartRow" >
                    <div class="col-sm-4 cartLabel">
                        {{ trans('booking/index.cartCategory') }}:
                    </div>
                    <div class="col-sm-8">
                        @{{ item.category_name }}
                    </div>
                </div>

                <div class="row inCartRow" >
                    <div class="col-sm-4 cartLabel">
                        {{ trans('booking/index.cartName') }}:
                    </div>
                    <div class="col-sm-8">
                        @{{ item.name }} @{{ item.resultId }}
                    </div>
                </div>

                <div v-if="(item.quantity > 0)" class="row inCartRow" >
                    <div class="col-sm-4 cartLabel">
                        {{ trans('booking/index.cartQuantity') }}:
                    </div>
                    <div class="col-sm-8">
                        @{{ Math.round(item.quantity) }} {{ trans('booking/index.pieces') }}
                    </div>
                </div>

                <div class="row inCartRow" >
                    <div class="col-sm-4 cartLabel">
                        {{ trans('booking/index.cartDate') }}:
                    </div>
                    <div class="col-sm-8">
                        @{{ item.startDate }}
                    </div>
                </div>
                <div class="row inCartRow" >
                    <div class="col-sm-4 cartLabel">
                        {{ trans('booking/index.cartStartTime') }}:
                    </div>
                    <div class="col-sm-8">
                        @{{ item.startTime }}
                    </div>
                </div>
                <div class="row inCartRow" v-show="item.productTimeType == 2 || item.productTimeType == 1" >
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
                        {{-- <span v-show="(item.productTimeType == 'perDay')">
                            @{{ item.durationDays }} {{ trans('booking/index.days') }}
                        </span>
                        <span v-show="(item.productTimeType == 'perHour')">
                            @{{ item.durationHours }} {{ trans('booking/index.hours') }}
                        </span>--}}
                    </div>
                </div>
                 <div class="row inCartRow" >
                    <div class="col-sm-4 cartLabel">
                        {{ trans('booking/index.cartPrice') }}:
                    </div>
                    <div class="col-sm-8">
                        @{{ parseInt(item.price, 10) }} {{ trans('booking/index.currency') }}
                    </div>
                </div>
                <div class="row inCartRow" >
                    <div class="col-sm-4 cartLabel">
                        {{ trans('booking/index.reservepercentage') }}:
                    </div>
                    <div class="col-sm-8">
                        @{{ parseInt(item.reservepercentage*item.price/100, 10) }} {{ trans('booking/index.currency') }}
                    </div>
                </div>

            </div>
            <div class="col-sm-2">
                {!! Form::open(array("class"=> "removeButton", "@submit.prevent" => 'removeCartItem(item.bookingLocationId, item.price, item.resultId )')) !!}

                    {!! Form::submit(trans('booking/index.delete'), array('class' => 'btn btn-warning')) !!}
                {!! Form::close() !!}</td>
            </div>
        </div>
    </div>

    {{--@if($booking <> "")
        @include('partials/productsInCart')
    @endif--}}


</div>
