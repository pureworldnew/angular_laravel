<?php

namespace App\Http\Controllers\Admin;

use App\BokaKanot\Klarna;
use App\BokaKanot\Repositories\BookingRepository;
use App\BokaKanot\UserUtil;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class KlarnaController extends Controller
{
    private $klarna;

    public function __construct(UserUtil $userUtil, Request $request)
    {
        $this->klarna = $userUtil->getCentreKlarna($userUtil->getUserCentreId($request));


    }

    public function activate(Request $request)
    {
        $bookingId = $request->input('bookingId');

        $this->klarna->activateBooking($bookingId);

        return redirect('admin/bookings');
    }

    public function activateSelectedProducts (Request $request)
    {
        $this->klarna->activateSelectedProducts($request->input('selectedActivateProducts'), $request->input('reservationId'), $request->input('bookingId'));


        //$this->session->set_flashdata('adminMessage', 'Products Activated');

        return redirect("admin/booking/".$request->input('bookingId'));
    }

    public function refundSelectedProducts (Request $request)
    {
        $this->klarna->refundSelectedProducts($request->input('selectedCancelProducts'), $request->input('bookingId'));


        //$this->session->set_flashdata('adminMessage', 'Products Activated');

        return redirect("admin/booking/".$request->input('bookingId'));
    }
}
