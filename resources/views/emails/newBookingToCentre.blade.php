<html>
    <body>
        <h3>{{ trans('emails/newBookingToCentre.heading') }}</h3>
        <p>{{ trans('emails/newBookingToCentre.text') }}</p>
        <p>{{ trans('emails/newBookingToCentre.cancelText') }}</p>
        <p>{{ $cancelLink }}</p>
        {!! $emailProductTable  !!}
    </body>
</html>