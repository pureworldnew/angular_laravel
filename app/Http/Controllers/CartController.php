<?php

namespace App\Http\Controllers;

use App\BokaKanot\Repositories\BookingRepository;
use App\BokaKanot\Transformers\CartProductTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends ApiController
{
    /**
     * @var CartProductTransformer
     */
    private $cartProductTransformer;

    public function __construct(CartProductTransformer $cartProductTransformer)
    {

        $this->cartProductTransformer = $cartProductTransformer;
    }

    public function emptyCart(Request $request)
    {
        Session::pull('bookingId');
        Session::pull('totalPrice');

        $booking = \App\Booking::find($request->input('bookingId'));

        $booking->delete();
        return redirect('/booking');
    }

    public function fetchCart(Request $request, BookingRepository $bookingRepository)
    {
        $cartProducts = $bookingRepository->getAllBookingProducts($request->input('bookingId'), $request->input('bookingToken'));
        $transformedProducts = [];
        
        foreach ($cartProducts as $cartProduct)
        {
            $transformedProducts[] = $this->cartProductTransformer->transform($cartProduct);
        }

        return $this->respond([
            'id' => $request->input('bookingId'),
            'token' => $request->input('bookingToken'),
            'products' => $transformedProducts
        ]);

    }
}
