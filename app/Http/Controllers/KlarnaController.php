<?php

namespace App\Http\Controllers;

use App\BokaKanot\LocalisationCms;
use App\BokaKanot\Repositories\CentreRepository;
use App\BokaKanot\UserUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class KlarnaController extends Controller
{
    public function terms ($urlSlug, LocalisationCms $localisationCms, Request $request, UserUtil $userUtil, CentreRepository $centreRepository)
    {
        $centreId = $centreRepository->getCentreFromSlug($urlSlug)->id;
        
        $logo = $centreRepository->getCentreLogo($centreId);

        return view('klarna.terms')->with([
            "bookingConditions" => $localisationCms->getLocaleString(App::getLocale(), "booking_conditions", $centreId),
            "logo" => $logo
        ]);
    }
}