<html>
    <body>
        <h3>{{ trans('emails/cancelBookingToCustomer.heading') }}</h3>
        <p>{{ trans('emails/cancelBookingToCustomer.text1').$bookingId.trans('emails/cancelBookingToCustomer.text2') }}</p>
        <p>{{ trans('emails/cancelBookingToCustomer.text3') }}</p>

    </body>
</html>