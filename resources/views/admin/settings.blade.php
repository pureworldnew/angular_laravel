@extends('app')

@section('meta')

    {{--<link href="bootstrap.css" rel="stylesheet">--}}
    <link href="/css/bootstrap-switch.min.css" rel="stylesheet">

  

@endsection

@section('content')
<style>
        #confirmNavBox {
            margin-top: 200px;
        }
        fieldset fieldset {
            /*border-bottom: 1px solid #999;*/
            margin-bottom: 15px;
        }
        #paymentCashHow {
            margin-left: 40px;
            width: 80%;
        }
        label.paymentHow {
            padding-left:0;
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px;
            font-weight: 700;
        }
        #holiday-list {
           /* display: none; */
        }
        #holiday-list table td,#holiday-list table th {
            padding: 3px 10px;
            text-align: center;
        }
        #holiday-list table button {
            background: transparent;
            color: red;
            border: 0px;
            font-weight: bold;
        }
        #holiday-list table button:hover {
            text-decoration: underline;
        }
    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div class="contentBox">
                    <h1>{{ trans ('admin/settings.mainHeading') }}</h1>
                    <br>
                    @if (session('message') <> "")
                        <div class="alert alert-success">
                            <ul>
                                <li>{{ session('message') }}</li>
                            </ul>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                {!! Form::model($centre, ['method' => 'PATCH', 'action' => ['CentreController@update', $centre->id], 'class' => 'form-horizontal', 'id' => 'settingsForm']) !!}
                    {!! Form::hidden('redirectUrl', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", [ 'id' => 'redirectUrl'] ) !!}
                <div class="contentBox" id="settingsTab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#information" aria-controls="information" role="tab" data-toggle="tab">{{ trans ('admin/settings.information') }}</a></li>
                        <li role="presentation"><a href="#payment" aria-controls="payment" role="tab" data-toggle="tab">{{ trans ('admin/settings.payment') }}</a></li>
                        <li role="presentation"><a href="#swedish" aria-controls="swedish" role="tab" data-toggle="tab">{{ trans ('admin/settings.swedish') }}</a></li>
                        <li role="presentation"><a href="#english" aria-controls="english" role="tab" data-toggle="tab">{{ trans ('admin/settings.english') }}</a></li>
                        <li role="presentation"><a href="#german" aria-controls="german" role="tab" data-toggle="tab">{{ trans ('admin/settings.german') }}</a></li>
                    </ul>
                </div>
                <br><br>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="information">

                        <fieldset>

                            <legend>{{ trans('admin/settings.companyDetails') }}</legend>

                            <div class="form-group">
                                {!! Form::label('name', trans('admin/settings.nameLabel')) !!}
                                {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.namePlaceholder'))) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', trans('admin/settings.confirmation_emailLabel')) !!}
                                {!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => trans('admin/settings.confirmation_emailLabel'))) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('logo_url', trans('admin/settings.logoLabel')) !!}
                                {!! Form::text('logo_url', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.logoPlaceholder'))) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('telephone', trans('admin/settings.telephoneLabel')) !!}
                                {!! Form::text('telephone', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.telephonePlaceholder'))) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('address1', trans('admin/settings.address1Label')) !!}
                                {!! Form::text('address1', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.address1Placeholder'))) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('address2', trans('admin/settings.address2Label')) !!}
                                {!! Form::text('address2', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.address2Placeholder'))) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('post_code', trans('admin/settings.post_codeLabel')) !!}
                                {!! Form::text('post_code', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.postcodePlaceholder'))) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('web_page', trans('admin/settings.web_pageLabel')) !!}
                                {!! Form::text('web_page', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.web_pagePlaceholder'))) !!}
                            </div>
                        </fieldset>

                        <div class="form-group">
                            {!! Form::label('noDaysBeforeCancel', trans('admin/settings.noDaysBeforeCancelLabel')) !!}
                            {!! Form::text('noCancelDays', $centre->noCancelDays, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.noDaysBeforeCancelPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('num_pay_advance_days', trans('admin/settings.num_pay_advance_daysLabel')) !!}
                            {!! Form::text('num_pay_advance_days', $centre->num_pay_advance_days, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.num_pay_advance_daysPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('default_language', trans('admin/settings.defaultLanguageLabel')) !!}
                            {!! Form::select('default_language', Config::get('languages'), array('class' => 'form-control input')) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('bookingFee', trans('admin/settings.pricePerBookingLabel')) !!}
                            {!! Form::text('bookingFee', $centre->bookingFee, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.pricePerBookingPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('useAdminFee', trans('admin/settings.useAdminFeeLabel')) !!}
                            {!! Form::checkbox('useAdminFee', "1", (($centre->useAdminFee == 1) ? true : false), array('class' => 'checkbox', 'id' => 'checkAdminFee', 'placeholder' => trans ('admin/settings.useAdminFeePlaceholder'))) !!}
                        </div>
                        <div style="display:none" class="form-group adminFee">
                            {!! Form::label('adminFee', trans('admin/settings.adminFeeLabel')) !!}
                            {!! Form::text('adminFee', $centre->adminFee, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.adminFeePlaceholder'))) !!}
                        </div>
                        <div class="form-group" style="position: relative">
                            <h5><b>Opening Hours</b></h5>
                            <input name="startTime" class="timepicker form-control" type="text" value="{{$centre->startTime}}"><br>
                            <h5><b>Closing Hours</b></h5>
                            <input name="endTime" class="timepicker form-control" type="text" value="{{$centre->endTime}}"><br>
                            <h5><b>Select Holidays</b></h5>               
                            <input type="text" id="holidaysrange" autocomplete="off" name="holidaysrange" value="{{$centre->holidaysrange}}" class="datepicker-here form-control" autoClose = FALSE/>
							<input type="hidden" id="holiday" name="holidays" value="{{$centre->holidays}}"/>
                            <div id="holiday-list">
                                <table>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                         <div class="form-group">
                            {!! Form::label('Beh??ver logga in f??r att boka', trans ('admin/settings.needlogin')) !!}<br>
                            <select name="NeedLogin" class="form-control" id="NeedLogin">
                             @if($centre->NeedLogin == 'av') <!-- Off-->
                                  <option selected="selected" value="av">{{trans ('admin/settings.yes')}}</option>
                                  <option value="p??">{{trans ('admin/settings.no')}}</option>
                              @elseif($centre->NeedLogin == 'p??')<!-- On-->
                                  <option  value="av">{{trans ('admin/settings.yes')}}</option>
                                  <option selected="selected" value="p??">{{trans ('admin/settings.no')}}</option>
                              @endif
                            </select>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="payment">
                            <h3>{{  trans('admin/settings.paymentMethodHeading') }}</h3>

                            @foreach($paymentMethods as $method)
                                <div class="checkbox">
                                    <label><input id="paymentMethod{{ $method->shortName }}" type="checkbox" name="payment_methods[{{ $method->shortName }}]" value="{{ $method->shortName }}" {{ !empty($method->active) ? 'checked' : '' }}>{{ $method->name }}</label>
                                    @if($method->shortName == 'Cash')
                                        <fieldset class="paymentCashHow">
                                            @foreach (Config::get('languages') as $lang => $language)
                                                <div class="form-group">
                                                    {!! Form::label('custom_text[paymentCashHow]['.$lang.']', trans('admin/settings.paymentCashHowTextLabel_'.$lang), [ 'class' => 'paymentHow paymentCashHow']) !!}
                                                    {!! Form::textarea('custom_text[paymentCashHow]['.$lang.']', !array_key_exists("paymentCashHow", $customTexts) ? null : $customTexts["paymentCashHow"][$lang], array('class' => 'form-control paymentCashHow', 'placeholder' => trans ('admin/settings.paymentCashHowPlaceholder_'.$lang))) !!}
                                                </div>
                                            @endforeach

                                        </fieldset>
                                    @elseif($method->shortName == 'Invoice')
                                        <input name="paymentInvoiceHow" id="paymentInvoiceHow" style="display:none" type="text" placeholder="Explain how to play by invoice" value=""/>
                                        <fieldset class="paymentInvoiceHow">
                                            @foreach (Config::get('languages') as $lang => $language)
                                                <div class="form-group">
                                                    {!! Form::label('custom_text[paymentInvoiceHow]['.$lang.']', trans('admin/settings.paymentInvoiceHowTextLabel_'.$lang), [ 'class' => 'paymentHow paymentInvoiceHow']) !!}
                                                    {!! Form::textarea('custom_text[paymentInvoiceHow]['.$lang.']', !array_key_exists("paymentInvoiceHow", $customTexts) ? null : $customTexts["paymentInvoiceHow"][$lang], array('class' => 'form-control paymentInvoiceHow', 'placeholder' => trans ('admin/settings.paymentInvoiceHowPlaceholder_'.$lang))) !!}
                                                </div>
                                            @endforeach
                                        </fieldset>
                                    @elseif($method->shortName == 'Transfer')
                                        <input name="paymentTransferHow" id="paymentTransferHow" style="display:none" type="text" placeholder="Explain how to play by invoice" value=""/>
                                        <fieldset class="paymentTransferHow">
                                            @foreach (Config::get('languages') as $lang => $language)
                                                <div class="form-group">
                                                    {!! Form::label('custom_text[paymentTransferHow]['.$lang.']', trans('admin/settings.paymentTransferHowTextLabel_'.$lang), [ 'class' => 'paymentHow paymentTransferHow']) !!}
                                                    {!! Form::textarea('custom_text[paymentTransferHow]['.$lang.']', !array_key_exists("paymentTransferHow", $customTexts) ? null : $customTexts["paymentTransferHow"][$lang], array('class' => 'form-control paymentTransferHow', 'placeholder' => trans ('admin/settings.paymentTransferHowPlaceholder_'.$lang))) !!}
                                                </div>
                                            @endforeach
                                        </fieldset>
                                    @elseif($method->shortName == 'Klarna')

                                        <fieldset class="paymentKlarna">
                                            <h4>{{  trans('admin/settings.klarnaTestMode') }}:</h4>
                                            <p>{!! Form::checkbox('klarna_test_mode', 1, $centre->klarna_test_mode, [ 'id'=> 'klarnaTestMode']) !!}</p>
                                            <p><a href="https://merchants.klarna.com">{{  trans('admin/settings.klarnaOnlineManagementTool') }}</a></p>
                                            <h4>{{  trans('admin/settings.onlyKlarnaPayments') }}:</h4>
                                            <p>{!! Form::checkbox('klarna_only', 1, $centre->klarna_only, [ 'id'=> 'klarna_only']) !!}</p>
                                        </fieldset>
                                        <fieldset class="paymentKlarna">
                                            <h4>{{  trans('admin/settings.klarnaTestDetails') }}:</h4>
                                            <p><input name="klarna_api_key" class="form-control paymentKlarna" id="paymentKlarnaApiKey" style="display:none" type="text" placeholder="Enter your Klarna api merchant id" value="{{ $centre->klarna_api_key }}"/></p>
                                            <p><input name="klarna_api_secret" class="form-control paymentKlarna" id="paymentKlarnaApiSecret" style="display:none" type="text" placeholder="Enter your Klarna api secret key" value="{{ $centre->klarna_api_secret }}"/></p>
                                        </fieldset>
                                        <fieldset class="paymentKlarna">
                                            <h4>{{  trans('admin/settings.klarnaLiveDetails') }}:</h4>
                                            <p><input name="klarna_api_key_live" class="form-control paymentKlarna" id="payment KlarnaApiKey" style="display:none" type="text" placeholder="Enter your Klarna api merchant id" value="{{ $centre->klarna_api_key_live }}"/></p>
                                            <p><input name="klarna_api_secret_live" class="form-control paymentKlarna" id="paymentKlarnaApiSecret" style="display:none" type="text" placeholder="Enter your Klarna api secret key" value="{{ $centre->klarna_api_secret_live }}"/></p>
                                        </fieldset>
                                    @elseif($method->shortName == 'Stripe')
                                        <fieldset class="paymentStripe">
                                            <p><input name="stripe_secret_key" class="form-control paymentStripe" id="paymentKlarnaApiKey" style="display:none" type="text" placeholder="Enter your Stripe secret key" value="{{ $centre->stripe_secret_key }}"/></p>
                                            <p><input name="stripe_publishable_key" class="form-control paymentStripe" id="paymentKlarnaApiSecret" style="display:none" type="text" placeholder="Enter your Stripe publishable key" value="{{ $centre->stripe_publishable_key }}"/></p>
                                        </fieldset>  
									@elseif($method->shortName == 'Paypal')

                                        <fieldset class="paymentpaypal">
                                            <p><input name="paypalemail" class="form-control paypalemail" id="paypalemail" style="display:none" type="text" placeholder="Enter your Paypal Email" value="{{ $centre->paypalemail }}"/></p>
                                        </fieldset>
                                    @endif
                                </div>
                                @endforeach
                                </p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="swedish">
                        <div class="form-group">
                            {!! Form::label('custom_text[invoice_text][se]', trans('admin/settings.invoice_textLabelSe')) !!}
                            {!! Form::textarea('custom_text[invoice_text][se]', !array_key_exists("invoice_text", $customTexts) ? null : $customTexts["invoice_text"]["en"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.invoice_textPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[intro_text][se]', trans('admin/settings.intro_textLabelSe')) !!}
                            {!! Form::textarea('custom_text[intro_text][se]', !array_key_exists("intro_text", $customTexts) ? null : $customTexts["intro_text"]["se"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.intro_textLabel'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[confirmation_text][se]', trans('admin/settings.confirmationText_textLabelSe')) !!}
                            {!! Form::textarea('custom_text[confirmation_text][se]', !array_key_exists("confirmation_text", $customTexts) ? null : $customTexts["confirmation_text"]["se"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.confirmationTextPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[booking_conditions][se]', trans('admin/settings.bookingConditions_textLabelSe')) !!}
                            {!! Form::textarea('custom_text[booking_conditions][se]', !array_key_exists("booking_conditions", $customTexts) ? null : $customTexts["booking_conditions"]["se"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.bookingRulesPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[payment_policy][se]', trans('admin/settings.paymentPolicy_textLabelSe')) !!}
                            {!! Form::textarea('custom_text[payment_policy][se]', !array_key_exists("payment_policy", $customTexts) ? null : $customTexts["payment_policy"]["se"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.paymentPolicyPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[admin_fee][se]', trans('admin/settings.adminFeeLabel_se')) !!}
                            {!! Form::textarea('custom_text[admin_fee][se]', !array_key_exists("admin_fee", $customTexts) ? null : $customTexts["admin_fee"]["se"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.adminFeePlaceholder_se'))) !!}
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="english">
                        <div class="form-group">
                            {!! Form::label('custom_text[invoice_text][en]', trans('admin/settings.invoice_textLabelEn')) !!}
                            {!! Form::textarea('custom_text[invoice_text][en]', !array_key_exists("invoice_text", $customTexts) ? null : $customTexts["invoice_text"]["en"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.invoice_textPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[intro_text][en]', trans('admin/settings.intro_textLabelEn')) !!}
                            {!! Form::textarea('custom_text[intro_text][en]', !array_key_exists("intro_text", $customTexts) ? null : $customTexts["intro_text"]["en"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.intro_textLabel'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[confirmation_text][en]', trans('admin/settings.confirmationText_textLabelEn')) !!}
                            {!! Form::textarea('custom_text[confirmation_text][en]', !array_key_exists("confirmation_text", $customTexts) ? null : $customTexts["confirmation_text"]["en"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.confirmationTextPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[booking_conditions][en]', trans('admin/settings.bookingConditions_textLabelEn')) !!}
                            {!! Form::textarea('custom_text[booking_conditions][en]', !array_key_exists("booking_conditions", $customTexts) ? null : $customTexts["booking_conditions"]["en"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.bookingRulesPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[payment_policy][en]', trans('admin/settings.paymentPolicy_textLabelEn')) !!}
                            {!! Form::textarea('custom_text[payment_policy][en]', !array_key_exists("payment_policy", $customTexts) ? null : $customTexts["payment_policy"]["en"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.paymentPolicyPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[admin_fee][en]', trans('admin/settings.adminFeeLabel_en')) !!}
                            {!! Form::textarea('custom_text[admin_fee][en]', !array_key_exists("admin_fee", $customTexts) ? null : $customTexts["admin_fee"]["en"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.adminFeePlaceholder_en'))) !!}
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="german">
                        <div class="form-group">
                            {!! Form::label('custom_text[invoice_text][de]', trans('admin/settings.invoice_textLabelDe')) !!}
                            {!! Form::textarea('custom_text[invoice_text][de]', !array_key_exists("invoice_text", $customTexts) ? null : $customTexts["invoice_text"]["en"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.invoice_textPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[intro_text][de]', trans('admin/settings.intro_textLabelDe')) !!}
                            {!! Form::textarea('custom_text[intro_text][de]', !array_key_exists("intro_text", $customTexts) ? null : $customTexts["intro_text"]["de"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.intro_textLabel'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[confirmation_text][de]', trans('admin/settings.confirmationText_textLabelDe')) !!}
                            {!! Form::textarea('custom_text[confirmation_text][de]', !array_key_exists("confirmation_text", $customTexts) ? null : $customTexts["confirmation_text"]["de"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.confirmationTextPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[booking_conditions][de]', trans('admin/settings.bookingConditions_textLabelDe')) !!}
                            {!! Form::textarea('custom_text[booking_conditions][de]', !array_key_exists("booking_conditions", $customTexts) ? null : $customTexts["booking_conditions"]["de"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.bookingRulesPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[payment_policy][de]', trans('admin/settings.paymentPolicy_textLabelDe')) !!}
                            {!! Form::textarea('custom_text[payment_policy][de]', !array_key_exists("payment_policy", $customTexts) ? null : $customTexts["payment_policy"]["de"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.paymentPolicyPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('custom_text[admin_fee][de]', trans('admin/settings.adminFeeLabel_de')) !!}
                            {!! Form::textarea('custom_text[admin_fee][de]', !array_key_exists("admin_fee", $customTexts) ? null : $customTexts["admin_fee"]["de"], array('class' => 'form-control', 'placeholder' => trans ('admin/settings.adminFeePlaceholder_de'))) !!}
                        </div>
                    </div>

                    {{--<fieldset>
                        <legend>Customize texts</legend>
                        <div class="form-group">
                            {!! Form::label('invoice_text', trans('admin/settings.invoice_textLabel')) !!}
                            {!! Form::text('invoice_text', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.invoice_textPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('intro_text', trans('admin/settings.intro_textLabel')) !!}
                            {!! Form::textarea('intro_text', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.introPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('confirmation_text', trans('admin/settings.confirmation_textLabel')) !!}
                            {!! Form::textarea('confirmation_text', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.confirmationTextPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('confirmation_email', trans('admin/settings.confirmation_emailLabel')) !!}
                            {!! Form::textarea('confirmation_email', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.emailPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('booking_conditions', trans('admin/settings.booking_conditionsLabel')) !!}
                            {!! Form::textarea('booking_conditions', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.bookingRulesPlaceholder'))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('payment_policy', trans('admin/settings.payment_policyLabel')) !!}
                            {!! Form::textarea('payment_policy', null, array('class' => 'form-control', 'placeholder' => trans ('admin/settings.paymentPolicyPlaceholder'))) !!}
                        </div>
                    </fieldset>
--}}


                </div>
                <!DOCTYPE html>

<html>

<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="/css/datepicker.min.css" rel="stylesheet" type="text/css">
        <script src="/js/datepicker.min.js"></script>

        <!-- Include English language -->
        <script src="/js/i18n/datepicker.en.js"></script>
</head>
<script type="text/javascript">
    $('.timepicker').datetimepicker({
        format: 'HH:mm'
    });
    let $holiday = $('#holidaysrange'),
    options = {
        language: 'en',
        dateFormat: "yyyy/mm/dd",
        multipleDates: true,
        multipleDatesSeparator: ", ",
        onSelect: function onSelect(fd, date) {
        }
    };
    
    $holiday.daterangepicker({locale: {
      format: 'YYYY/MM/DD'
    }});
    let $holidayApi = $holiday.data("daterangepicker");
    var setHolidays = function(holidayList = []) {
        console.log("Holiday list", holidayList);
        let tab = document.querySelector("#holiday-list table");
        while(tab.rows.length>1) {
            tab.deleteRow(1);
        }
        
        let index = 0;
        holidayList.forEach((holiday) => {
            let row = tab.insertRow();
            let deleteButton = document.createElement("button");
            deleteButton.innerText = "Remove";
            deleteButton.value = index;
            deleteButton.onclick = function(e) {
                let index = e.target.value;
                holidayList.splice(index, 1);
                holidayRanges.splice(index, 1);
				setranges(holidayRanges)
				console.log(holidayList);
                setHolidays(holidayList);
				$("#holidaysrange").val(holidayList.join(","));
              /*   let holidays = $('#holiday').val();
                $holidayApi.clear();
                if(holidays.length) {
                    $holidayApi.selectDate(holidayList.map(x=>new Date(x)));
                } */
                
                e.preventDefault();
                return false;
            };
            
            row.insertCell(0).innerHTML = ++index;
            row.insertCell(1).innerHTML = holiday;
            row.insertCell(2).appendChild(deleteButton);
        });
      /*   let selectedDates = holidayList.map((holiday) => {
            return new Date(holiday);
        }); */
        
    }
	
	var holidayList = [];
	var holidayRanges = [];
	var setRange = false;
	
    $('#holidaysrange').on('apply.daterangepicker', function(ev, picker) {
		dates = getDates(new Date(picker.startDate.format('YYYY/MM/DD')),new Date(picker.endDate.format('YYYY/MM/DD')));
		holidayRanges.push(dates);
		setranges(holidayRanges);
		holidayList.push($(this).val());
		setHolidays(holidayList);
		$("#holidaysrange").val(holidayList.join(","));
   /*      let holidayList = $('#holiday').val();
        if(holidayList.length) {
            setHolidays(holidayList.split(','));
        } */
    });     
	document.getElementById('holidaysrange').value = '{{$centre->holidaysrange}}';
    let holidays_list = document.getElementById('holidaysrange').value;
    if(holidays_list.length) {
	     holidayList = holidays_list = holidays_list.split(",");
		 holidays_list.forEach((holiday) => {
			aa = holiday.split(" - ");
	
			dates = getDates(new Date(aa[0]),new Date(aa[1]));
			console.log(aa);
			console.log(dates);
			holidayRanges.push(dates);
			setranges(holidayRanges);
		 });
		setHolidays(holidayList);
    } 
        
    // $("#holiday").val(holidayList.join(","));
	
	
 function setranges(holidayrange){
	 var arr = [];
	 holidayrange.forEach((holiday) => {
		arr.push(holiday.join(", "));
	 });
	 setRange = arr.join(", ");
	 $('#holiday').val(setRange);
 }
  function getDates(startDate, endDate) {
  var dates = [],
      currentDate = startDate,
      addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
      };
  while (currentDate <= endDate) {
    dates.push(dateFormat(currentDate));
    currentDate = addDays.call(currentDate, 1);
  }
  return dates;
}

function dateFormat(today){
	var dd = today.getDate();

	var mm = today.getMonth()+1; 
	var yyyy = today.getFullYear();
	if(dd<10) 
	{
		dd='0'+dd;
	} 

	if(mm<10) 
	{
		mm='0'+mm;
	} 
	return today = yyyy+'/'+mm+'/'+dd;
}
</script>
</body>

</html>
                <br>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary'])  !!}

                    {!! Form::close() !!}
    <br/>
    <br/>
                    <p>{!! $sessionMessage !!}</p>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script>
        $(document).ready(function(){

            $('#checkAdminFee').click(function(){
                if($(this).is(':checked'))
                {
                    $('.adminFee').show();
                }
                else
                {
                    $('.adminFee').hide();
                }

            });

            if($('#checkAdminFee').is(':checked'))
            {
                $('.adminFee').show();
            }

            $("#settingsForm").submit(function() {
                $('#redirectUrl').val(window.location.href);

                return true;

            });

            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop() || $('html').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });

            if($("#paymentMethodCash").is(':checked'))
            {
                $(".paymentCashHow").show();
            }

			if($("#paymentMethodPaypal").is(':checked'))
            {
                $(".paypalemail").show();
            }
            else
            {
                $(".paymentCashHow").hide();
            }

            if($("#paymentMethodInvoice").is(':checked'))
            {
                $(".paymentInvoiceHow").show();
            }
            else
            {
                $(".paymentInvoiceHow").hide();
            }

            if($("#paymentMethodTransfer").is(':checked'))
            {
                $(".paymentTransferHow").show();
            }
            else
            {
                $(".paymentTransferHow").hide();
            }

            if($("#paymentMethodKlarna").is(':checked'))
            {
                $(".paymentKlarna").show();
            }
            else
            {
                $(".paymentKlarna").hide();
            }

            if($("#paymentMethodStripe").is(':checked'))
            {
                $(".paymentStripe").show();
            }
            else
            {
                $(".paymentStripe").hide();
            }
            $('#settingsTab a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });

            $("#paymentMethodTransfer").click(function(){
                $(".paymentTransferHow").toggle();
            });
            $("#paymentMethodCash").click(function(){
                $(".paymentCashHow").toggle();
            });
            $("#paymentMethodInvoice").click(function(){
                $(".paymentInvoiceHow").toggle();
            });
            $("#paymentMethodKlarna").click(function(){
                $(".paymentKlarna").toggle();
            });
            $("#paymentMethodStripe").click(function(){
                $(".paymentStripe").toggle();
            }); 

			$("#paymentMethodPaypal").click(function(){
                $(".paypalemail").toggle();
            });

            $("#klarnaTestMode").bootstrapSwitch();
            $("#klarna_only").bootstrapSwitch();

            /*$("#klarnaTestMode").on('switchChange.bootstrapSwitch', function(event, state) {
                console.log(this); // DOM element
                console.log(event); // jQuery event
                console.log(state); // true | false
            });
*/

        });
</script>
@endsection

@section('footer')
    <script>

    </script>
@endsection