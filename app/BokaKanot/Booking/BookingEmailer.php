<?php namespace App\BokaKanot\Booking;

//use App\Libraries;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class BookingEmailer
{
    private $local = false;
    private $sendEmail = true;

    public function __construct()
    {
        if(strpos($_SERVER['HTTP_HOST'], 'localhost') > -1)
        {
            $this->local = true;
           // $this->sendEmail = false;
        }
    }

    public function newBooking($bookingEmail, $name, $cancelLink, $emailProductTable, $centreEmail)
    {
        $data['email'] = $bookingEmail;
        $data['name'] = $name;
        $data['cancelLink'] = $cancelLink;
        $data['emailProductTable'] = $emailProductTable;
        $data['centreEmail'] = $centreEmail;

        Mail::send('emails.newBookingToCentre', $data, function($message) use ($data)
        {
            //Config::get('mail.superAdmin')
            $message->to($data['centreEmail'], $data['centreEmail'])
                ->subject(trans('emails/newBookingToCentre.subject'));
        });

        Mail::send('emails.newBookingToCustomer', $data, function($message) use ($data)
        {
            $message->to($data['email'], $data['email'])
                ->subject(trans('emails/newBookingToCustomer.subject'));
        });

    }

    public function cancelBooking($bookingEmail, $name, $centreEmail, $bookingId)
    {
        $data['email'] = $bookingEmail;
        $data['name'] = $name;
        $data['centreEmail'] = $centreEmail;
        $data['bookingId'] = $bookingId;

        Mail::send('emails.cancelBookingToCentre', $data, function($message) use ($data)
        {
            //Config::get('mail.superAdmin')
            $message->to($data['centreEmail'], $data['centreEmail'])
                ->subject(trans('emails/cancelBookingToCentre.subject'));
        });

        Mail::send('emails.cancelBookingToCustomer', $data, function($message) use ($data)
        {
            $message->to($data['email'], $data['email'])
                ->subject(trans('emails/cancelBookingToCustomer.subject'));
        });

    }

    public function activateEmail ($bookingEmail, $name, $centreEmail, $bookingId)
    {
        $data['email'] = $bookingEmail;
        $data['name'] = $name;
        $data['centreEmail'] = $centreEmail;
        $data['bookingId'] = $bookingId;

        if($this->sendEmail)
        {
            $subject = trans('emails/activateBookingToCentre.subject');
            Mail::send('emails.activateBookingToCentre', $data, function($message) use ($subject, $data)
            {
                $message->to($data['centreEmail'], $data['centreEmail'])
                    ->subject($subject);
            });

            $subject = trans('emails/activateBookingToCustomer.subject');
            Mail::send('emails.activateBookingToCustomer', $data, function($message) use ($subject, $data)
            {
                $message->to($data['email'], $data['email'])
                    ->subject($subject);
            });
        }

        /*Mail::send('emails.activateBookingToCentre', $data, function($message) use ($data)
        {
            $message->to($data['centreEmail'], $data['email'])
                ->subject(trans('emails/activateBookingToCentre.subject'));
        });

        Mail::send('emails.activateBookingToCustomer', $data, function($message) use ($data)
        {
            $message->to($data['email'], $data['centreEmail'])
                ->subject(trans('emails/activateBookingToCustomer.subject'));
        });*/
    }

    public function activateProductEmail ($bookingEmail, $name, $centreEmail, $bookingId)
    {
        $data['email'] = $bookingEmail;
        $data['name'] = $name;
        $data['centreEmail'] = $centreEmail;
        $data['bookingId'] = $bookingId;

        $this->send('emails/activateBookingToCentre.subject', 'emails.activateProductToCentre', $data);
        $this->send('emails/activateBookingToCustomer.subject', 'emails.activateProductToCustomer', $data);

      /*  Mail::send('emails.activateProductToCentre', $data, function($message) use ($data)
        {
            $message->to($data['centreEmail'], $data['email'])
                ->subject(trans('emails/activateBookingToCentre.subject'));
        });

        Mail::send('emails.activateProductToCustomer', $data, function($message) use ($data)
        {
            $message->to($data['email'], $data['centreEmail'])
                ->subject(trans('emails/activateBookingToCustomer.subject'));
        });*/
    }
}

