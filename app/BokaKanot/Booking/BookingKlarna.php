<?php namespace App\BokaKanot\Booking;

use App\BokaKanot\Interfaces\BillingInterface;
use App\BokaKanot\UserUtil;
use App\Booking;
use Illuminate\Support\Facades\Session;

class BookingKlarna
{
    private $klarna;

    public function __construct($centreId, UserUtil $userUtil)
    {
        //totally
        $this->klarna = $userUtil->getCentreKlarna($centreId);

        $this->userUtil = $userUtil;

    }

    public function updateKlarna (Booking $booking, $bookingProductId, $removeQuantity)
    {
        $bookingProduct = $booking->products()->wherePivot('id', $bookingProductId)->first();

        if ($bookingProduct->isNew()) {

            //$response = $this->klarna->removeProductFromCart($booking->klarna_reservationId, $booking->klarna_orderId, $booking->products, $bookingProductId, $booking->getKlarnaBookingAddress());
            $updateKlarna = $this->klarna->updateCart($booking->klarna_reservationId, $booking->klarna_orderId, $booking->products, $booking->getKlarnaBookingAddress());

            if($updateKlarna['error']) {
                dd($updateKlarna['error']);
            }

            Session::flash('flashMessage', trans('errors/booking.productRemovedMessage'));
            

        }

        if ($bookingProduct->isActivated()) {
            
            $this->klarna->klarnaService->refundOrderProduct($removeQuantity, $booking->getProductInvoiceId($bookingProduct->pivot->id), $booking->getProductIdentifier($bookingProductId));

            Session::flash('flashMessage', trans('errors/booking.productRemovedMessage'));
        }
    }

}