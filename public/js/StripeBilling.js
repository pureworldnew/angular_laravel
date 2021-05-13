var StripeBilling = (function () {

    /*var stripeForm;
    var submitButton;
    var submitButtonValue;
*/
    function bindEvents () {
        this.stripeForm.on('submit', $.proxy(this.sendToken, this));
    }

    function init(form) {
        this.stripeForm = form;
        this.submitButton = this.stripeForm.find('#submitPay');
        this.submitButtonValue = this.submitButton.val();

        var stripeKey = $('meta[name="publishable-key"]').attr('content');
        Stripe.setPublishableKey(stripeKey);

        this.bindEvents();
    }



    function sendToken (event) {

        event.preventDefault();


        this.submitButton.val('One Moment').prop('disabled', true);

        Stripe.createToken(this.stripeForm, $.proxy(this.stripeResponseHandler, this));


    }

    function stripeResponseHandler (status, response) {
        $('#billing-form span.error').hide();
        $('input.stripeInput').css('border', '1px solid #ccc');
        $("select.stripeInput").css('border', '1px solid #ccc');

        if (response.error) {
            this.stripeForm.find('.payment-errors').show().text(response.error.message);

            $('.'+response.error.code).show();
            $('input.'+response.error.code).css('border', '1px solid red');
            $("select."+response.error.code).css('border', '1px solid red');
            return this.submitButton.prop('disabled', false).val(this.submitButtonValue);
        }

        $('<input>', {
            type: 'hidden',
            name: 'stripe-token',
            value: response.id
        }).appendTo(this.stripeForm);

        this.stripeForm[0].submit();
    }
    /*
    function publicFunction() {
        publicIncrement();
    }

    function publicIncrement() {
        privateFunction();
    }

    function publicGetCount(){
        return privateCounter;
    }
*/
    // Reveal public pointers to
    // private functions and properties

    return {
        init: init,
        sendToken: sendToken,
        stripeResponseHandler: stripeResponseHandler,
        bindEvents: bindEvents
    };

})();

/*
class StripeBilling {

    constructor() {
        debugger
        this.form = $('#billing-form');
        this.submitButton = StripeBilling.form.find('#submitPay');
        this.submitButtonValue = StripeBilling.submitButton.val();
    }


    init () {

        var stripeKey = $('meta[name="publishable-key"]').attr('content');
        Stripe.setPublishableKey(stripeKey);

        this.bindEvents();
    }
    bindEvents () {
        this.form.on('submit', $.proxy(this.sendToken, this));
    }

    sendToken (event) {

        event.preventDefault();


        submitButton.val('One Moment').prop('disabled', true);

        Stripe.createToken(StripeBilling.form, $.proxy(this.stripeResponseHandler, this));


    }

    stripeResponseHandler (status, response) {

        if (response.error) {
            this.form.find('.payment-errors').show().text(response.error.message);
            return this.submitButton.prop('disabled', false).val(this.submitButtonValue);
        }

        $('<input>', {
            type: 'hidden',
            name: 'stripe-token',
            value: response.id
        }).appendTo(this.form);

        this.form[0].submit();
    }
}

export { StripeBilling }*/
/*

var StripeBilling = {

    form : $('#billing-form'),
    submitButton : StripeBilling.form.find('#submitPay'),
    submitButtonValue : StripeBilling.submitButton.val(),

    init: function() {
        /!*StripeBilling.form = $('#billing-form');
        StripeBilling.submitButton = this.form.find('#submitPay');
        StripeBilling.submitButtonValue = this.submitButton.val();*!/

        var stripeKey = $('meta[name="publishable-key"]').attr('content');
        Stripe.setPublishableKey(stripeKey);

        this.bindEvents();
    },

    bindEvents: function() {
        this.form.on('submit', $.proxy(this.sendToken, this));
    },

    sendToken: function(event) {

        event.preventDefault();


        submitButton.val('One Moment').prop('disabled', true);

        Stripe.createToken(StripeBilling.form, $.proxy(this.stripeResponseHandler, this));


    },

    stripeResponseHandler: function(status, response) {
        if (response.error) {
            this.form.find('.payment-errors').show().text(response.error.message);
            return this.submitButton.prop('disabled', false).val(this.submitButtonValue);
        }

        $('<input>', {
            type: 'hidden',
            name: 'stripe-token',
            value: response.id
        }).appendTo(this.form);

        this.form[0].submit();
    }
};
*/


//export default StripeBilling;