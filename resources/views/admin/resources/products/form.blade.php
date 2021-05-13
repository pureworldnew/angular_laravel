@section('footer')
    <script>
        $(document).ready(function(e) {
            $(".perTypeproduct").hide();
            $(".perTypebooking").hide();
            $('.perTypetime').hide();
            $('.perType').hide();
            $('#perTypeproduct').click(function(){
                $('.perTypetime').hide();
                $('.perTypebooking').hide();
                $('.perTypeproduct').show();
            }); //time, booking
            $('#perTypebooking').click(function(){
                $('.perTypetime').hide();
                $('.perTypeproduct').hide();
                $('.perTypebooking').show();
            });
            $('#perTypetime').click(function(){
                $('.perTypebooking').hide();
                $('.perTypeproduct').hide();
                $('.perTypetime').show();
            });
            $(".per_type_id").each(function(){
                if($(this).is(":checked"))
                {
                    $(this).trigger('click');
                }
            });
            //$('#perTypetime').trigger('click');
            $('.delete-image-btn').on('click', function() {

                if(confirm('<?php echo trans('admin/resources/productsForm.deleteImageConfirm');?>'))
                {
                    var productId = $(this).data('productid');
                    var productImageId = $(this).data('productimageid');

                    var ajax = $.ajax({
                        url: "/admin/resources/products/delete-image",
                        type: "DELETE",
                        data: {
                            'productId' : productId,
                            'productImageId' : productImageId
                        },
                        success: function (response) {
                            $('#productImageId'+productImageId).hide();
                        },
                        error: function (error) {
                            console.log(error);
                        },
                        dataType: "text"
                    })
                }

            });

            $('.make-image-primary-btn').on('click', function(evt) {

                if(confirm('<?php echo trans('admin/resources/productsForm.makePrimaryConfirm');?>'))
                {
                    var productId = $(this).data('productid');
                    var productImageId = $(this).data('productimageid');

                    var ajax = $.ajax({
                        url: "/admin/resources/products/make-image-primary",
                        type: "PATCH",
                        data: {
                            'productId' : productId,
                            'productImageId' : productImageId
                        },
                        success: function (response) {
                            $('.primary').each(function(){
                                $(this).removeClass('primary');
                            });

                            $newButton = $('#makePrimaryButton').clone(true);

                            $('.primaryImageText').each(function() {
                                $(this).replaceWith($newButton);
                            })
                            $(evt.target).replaceWith('<b class="primaryImageText">Primary image</b>');

                            $('#productImageId'+productImageId).addClass('primary');

                        },
                        error: function (error) {
                            console.log(error);
                        },
                        dataType: "text"
                    })
                }

            });
        });

    </script>
@endsection
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="form-group">
    {!! Form::label('category_id', trans('admin/resources/productsForm.categoryLabel')) !!}
    {!! Form::select('category_id', $categoryList, ['value' => (isset($product->category_id ) ? $product->category_id : (old('category_id') or "")) ]) !!}
</div>
<div>
 {!! Form::label('tag_color', trans('Colors')) !!}
 {!! Form::select('tag_color[]', $array, ['value' => (isset($array ) ? $array : in_array($tag_color, $tag_color) ? 'selected' : '' ) ], array('id' => 'users_list', 'multiple'=>'', 'size'=>'5')); !!}

</div>

<div>
 {!! Form::label('tag_size', trans('Size')) !!}
 {!! Form::select('tag_size[]', $arrayy, 'default', array('id' => 'users_listt', 'multiple'=>'', 'size'=>'5')); !!}

<!--</div>-->
<!--<div class="form-group">-->
<!-- {!! Form::label('category_id', trans('Size')) !!}-->
<!--<select name="tag_size[]" id="users_listt" multiple="multiple" size="5">-->
<!--    @foreach($arrayy as $val)-->
<!--    <option  value="a1">{{$val}}</option>-->
<!--    @endforeach-->
<!--</select>-->

</div>
   <!--<div class="form-group" >      -->
   <!-- <label for="tag_color">{{trans('Color')}}</label>    -->
   <!-- <select class="form-control" name="tag_color[]" id="searchcolor" multiple="multiple" >-->
   <!--     @foreach($array as $val)-->
   <!--     <option  value="{{$val}}">{{$val}}</option>-->
   <!--     @endforeach-->
   <!-- </select>-->

   <!-- </div>-->

   <!-- <div  class="form-group"><br>-->
   <!--  <label for="tag_size">{{trans('Size')}}</label>    -->
   <!--     <select class="form-control" name="tag_size[]" id="searchtag" multiple="multiple" >-->
   <!--         @foreach($arrayy as $val)-->
   <!--         <option  value="{{$val}}">{{$val}}</option>-->
   <!--         @endforeach-->
   <!--     </select>-->
    
   <!-- </div>-->
</div>
<div class="form-group">
    {!! Form::label('name', trans('admin/resources/productsForm.productText')) !!}
    {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans("admin/resources/productsForm.namePlaceHolder"))) !!}

</div>
<div class="form-group">
    {!! Form::label(trans('admin/resources/productsForm.descriptionText'), trans('admin/resources/productsForm.descriptionText')) !!}
    {!! Form::text('description', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.descriptionPlaceHolder'))) !!}

</div>

<!-- for New Language Form -->
<div class="form-group">
    {!! Form::label('name', trans('admin/resources/productsForm.productText_se')) !!}
    {!! Form::text('name_se', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans("admin/resources/productsForm.namePlaceHolder"))) !!}

</div>
<div class="form-group">
    {!! Form::label(trans('admin/resources/productsForm.descriptionText_se'), trans('admin/resources/productsForm.descriptionText_se')) !!}
    {!! Form::text('description_se', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.descriptionPlaceHolder'))) !!}

</div>
<div class="form-group">
    {!! Form::label('name', trans('admin/resources/productsForm.productText_de')) !!}
    {!! Form::text('name_de', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans("admin/resources/productsForm.namePlaceHolder"))) !!}

</div>
<div class="form-group">
    {!! Form::label(trans('admin/resources/productsForm.descriptionText_de'), trans('admin/resources/productsForm.descriptionText_de')) !!}
    {!! Form::text('description_de', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.descriptionPlaceHolder'))) !!}

</div>
<!-- End For New Language  -->
<div class="form-group">
    {!! Form::label(trans('admin/resources/productsForm.descriptionText'), trans('admin/resources/productsForm.quantityText')) !!}
    {!! Form::text('quantity', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.quantityPlaceHolder'))) !!}

</div>

<div class="form-group">
   <label for="Number of Persons">{{trans('admin/resources/productsForm.number_of_persons')}}</label>
   <input type="checkbox" name="number_of_persons" value="yes" {{ isset($product->number_of_persons) ? (($product->number_of_persons == 'yes') ? 'checked' : '') : ''  }} >
</div>
<div class="form-group">
    <h3>{{ trans('admin/resources/productsForm.ImagesHeading') }}:</h3>
<style>
    .productImageHolder.primary {
        border:1px solid #080808;
    }
    .primaryImageText {
        color: #222;
    }
    .productImageHolder {
        padding: 15px;
    }
</style>
@if(isset($product) and sizeof($product->product_images) > 0)
<?php $rowId = 1;?>
        @foreach($product->product_images as $productImage)
            @if($productImage->image AND $productImage->image <> "")
                @if($rowId % 2 == 0)
                    <div class="row">
                @endif
<?php                   $primaryClass="";
                        if ($productImage->primary_image)
                        {
                            $primaryClass = "primary";
                        }?>

                        <div id="productImageId{{ $productImage->id }}" class="col-sm-6 contentBoxHolder productImageHolder {{$primaryClass}}">
                            <div class="row">
                                <div class="col-sm-6 contentBoxHolder">
                                    <img style="float:left;width:200px;margin: 5px 20px 0 0" src="/images/products/{{$productImage->image}}" />
                                </div>
                                <div class="col-sm-6 contentBoxHolder">
                                    <div class="row">
                                        <div class="col-sm-12 contentBoxHolder">

                                            {!! Form::button(trans('admin/resources/productsForm.deleteImage'), array('data-productId' => $product->id, 'data-productImageId' => $productImage->id, 'url' => '/admin/resources/products/delete-image', 'method' => 'post', 'class' => 'delete-image-btn btn btn-default')) !!}

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 contentBoxHolder">
                                            <br/>
                                            @if ($productImage->primary_image)
                                                <b class="primaryImageText">Primary image</b>
                                            @else
                                                {!! Form::button(trans('admin/resources/productsForm.makePrimary'), array('id'=> 'makePrimaryButton', 'data-productId' => $product->id, 'data-productImageId' => $productImage->id, 'url' => '/admin/resources/products/make-image-primary', 'method' => 'post', 'class' => 'make-image-primary-btn btn btn-default')) !!}
                                            @endif

                                            {{--{!! Form::open(array('onclick' => "return confirm(".trans('admin/resources/productsForm.makePrimaryConfirm').");", 'url' => '/admin/resources/products/make-image-primary', 'method' => 'post', 'class' => 'bookLink')) !!}
                                            {!! Form::hidden('productId', $product->id) !!}
                                            {!! Form::hidden('productImageId', $productImage->id) !!}
                                            {!! Form::submit(trans('admin/resources/productsForm.makePrimary'), array('class' => 'btn btn-default')) !!}
                                            {!! Form::close() !!}--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                @if($rowId % 2 == 0)
                    </div>
                @endif
<?php $rowId = $rowId + 1;?>
            @endif
        @endforeach

    @endif
    {!! Form::label('image', trans('admin/resources/productsForm.imageText').":") !!}
    {!! Form::file('image') !!}
</div>
<div class="form-group">
    <h4>{{ trans('admin/resources/productsForm.selectHowProductBooked') }}:</h4>
    @foreach($productPerTypes as $perType)
        <div class="checkbox">
            {!! Form::radio("per_type_id", $perType->id,  (isset($product) ? $product->per_type_id == $perType->id : false), ['class' => 'per_type_id', 'id' => 'perType'.$perType->type_value]) !!}
            {!! Form::label('per_type_id', trans('admin/resources/productsForm.perType_'.$perType->type_value)) !!}
        </div>
    @endforeach
</div>

<div class="form-group perTypetime">
    <h4>{{ trans('admin/resources/productsForm.whatTimeBookedfor') }}:</h4>
    @foreach($productPerTypeTimes as $perTypetime)
        <div class="checkbox">
            {!! Form::checkbox("perTypeTime[$perTypetime->type_time_value]", $perTypetime->type_time_value,  (isset($perTypetime->active) AND $perTypetime->active == "1") ) !!}
            {!! Form::label('perTypeTime', trans('admin/resources/productsForm.perTypeTime_'.$perTypetime->type_time_value)) !!}
        </div>
        {!! Form::label('perTypeTime', trans('admin/resources/productsForm.perTypeTime_'.$perTypetime->type_time_value.'_max')) !!}
        {!! Form::text("perTypeTimeMax[$perTypetime->type_time_value]", (isset($perTypetime->max_duration)?$perTypetime->max_duration:0), array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.perTypeTime_'.$perTypetime->type_time_value.'_max'))) !!}
    @endforeach
</div>
<div class="form-group perType perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerHour'), trans('admin/resources/productsForm.pricePerHour'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerHour', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerHour'))) !!}
</div>
<div class="form-group perType perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerHourWeekend'), trans('admin/resources/productsForm.pricePerHourWeekend'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerHourWeekend', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerHourWeekend'))) !!}
</div>
<div class="form-group perType perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerHourOverFour'), trans('admin/resources/productsForm.pricePerHourOverFour'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerHourOverFour', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerHourOverFour'))) !!}
</div>
<div class="form-group perType perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerHourOverFourWeekend'), trans('admin/resources/productsForm.pricePerHourOverFourWeekend'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerHourOverFourWeekend', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerHourOverFourWeekend'))) !!}
</div>
<div class="form-group perType perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerDay'), trans('admin/resources/productsForm.pricePerDay'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerDay', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerDay'))) !!}
</div>
<div class="form-group perType perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerDayWeekend'), trans('admin/resources/productsForm.pricePerDayWeekend'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerDayWeekend', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerDayWeekend'))) !!}
</div>
<div class="form-group perType perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerTwoDays'), trans('admin/resources/productsForm.pricePerTwoDays'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerTwoDays', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerTwoDays'))) !!}
</div>
<div class="form-group perType perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerTwoDaysWeekend'), trans('admin/resources/productsForm.pricePerTwoDaysWeekend'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerTwoDaysWeekend', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerTwoDaysWeekend'))) !!}
</div>
<div class="form-group perType perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerThreeSixDays'), trans('admin/resources/productsForm.pricePerThreeSixDays'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerThreeSixDays', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerThreeSixDays'))) !!}
</div>
<div class="form-group perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerWeek'), trans('admin/resources/productsForm.pricePerWeek'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerWeek', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerWeekExtraDay'))) !!}
</div>
<div class="form-group perTypetime">
    {!! Form::label(trans('admin/resources/productsForm.pricePerWeekExtraDay'), trans('admin/resources/productsForm.pricePerWeekExtraDay'), ['class' => 'perTypetime']) !!}
    {!! Form::text('pricePerWeekExtraDay', null, array('class' => 'perTypetime form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerWeekExtraDay'))) !!}
</div>
{{--<div class="form-group">
    {!! Form::label(trans('admin/resources/productsForm.priceHalfDay'), trans('admin/resources/productsForm.priceHalfDay')) !!}
    {!! Form::text('priceHalfDay', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.priceHalfDay'))) !!}
</div>
<div class="form-group">
    {!! Form::label(trans('admin/resources/productsForm.priceHalfDayWeekend'), trans('admin/resources/productsForm.priceHalfDayWeekend')) !!}
    {!! Form::text('priceHalfDayWeekend', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.priceHalfDayWeekend'))) !!}
</div>--}}
<div class="form-group perType perTypeproduct">
    {!! Form::label(trans('admin/resources/productsForm.pricePerProduct'), trans('admin/resources/productsForm.pricePerProduct'), ['class' => 'perTypeproduct']) !!}
    {!! Form::text('pricePerProduct', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerProduct'))) !!}
</div>
<div class="form-group perType perTypebooking">
    {!! Form::label(trans('admin/resources/productsForm.pricePerBooking'), trans('admin/resources/productsForm.pricePerBooking', ['class' => 'perTypebooking'])) !!}
    {!! Form::text('pricePerBooking', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.enterText')." ".trans('admin/resources/productsForm.pricePerBooking'))) !!}
</div>
<div class="form-group">
    {!! Form::label(trans('admin/resources/productsForm.descriptionText'), trans('admin/resources/productsForm.reservepercentage')) !!}
    {!! Form::text('reservepercentage', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/productsForm.Enterreserve')." ".trans('admin/resources/productsForm.reservepercentage'))) !!}

</div>
<div class="form-group perTypetime perTypeproduct">
    <h4>{{ trans('admin/resources/productsForm.selectAvailStartTime') }}:</h4>
    @foreach($startTimes as $key => $startTime)
        <div class="checkbox">
            {!! Form::checkbox("startTime[$startTime->start_value]", $startTime->start_value,  (isset($startTime->active) AND    $startTime->active == "1") ) !!}
            {!! Form::label('paymentStartTime', $startTime->start_time) !!}
        </div>
    @endforeach
</div>

{!! Form::submit(trans('admin/resources/add.'.$submitButtonType."ButtonProduct"), ["class" => 'btn btn-success']) !!}
