<?php namespace App\BokaKanot\Booking;


use App\BokaKanot\Repositories\CentreRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class BookingStripe
{
    /**
     * @var CentreRepository
     */
    private $centreRepository;

    public function __construct(CentreRepository $centreRepository)
    {

        $this->centreRepository = $centreRepository;
    }

    public function refund($centreId, $refundAmount, $chargeId)
    {
        $parameters = [];
        $parameters['secret_key'] = $this->centreRepository->getCentreStripeSecretKey($centreId);
        $billing = App::make('App\BokaKanot\Interfaces\BillingInterface', $parameters);

        $refunded = $billing->refund($chargeId, $refundAmount);

        if ($refunded=="succeeded")
        {
            Session::flash('flashMessage', trans('errors/booking.productRemovedMessage'));
        }
        else
        {
            Session::flash('flashMessage', "Product refund failed with Stripe");
        }
    }
}