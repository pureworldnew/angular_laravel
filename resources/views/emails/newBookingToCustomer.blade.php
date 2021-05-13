<html>
    <body>
        <h3>{{ trans('emails/newBookingToCustomer.heading') }}</h3>
        <p>{{ trans('emails/newBookingToCustomer.text') }}</p>
        <p>{{ trans('emails/newBookingToCustomer.cancelText') }}</p>
        <p>{{ $cancelLink }}</p>
        {!! $emailProductTable  !!}
    </body>
</html>