<?php

namespace App\Http\Controllers\Admin;

use App\BokaKanot\Repositories\CustomerRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {

        $this->customerRepository = $customerRepository;
    }

    public function customers() {

        $customers = $this->customerRepository->getCustomers(Auth::user()->centres()->first()->id);

        return view('admin.reports.customers')->with([
            "adminPage" => "reports",
            "navPage" => "resources",
            "reportType" => "customers",
            "customers" => $customers
        ]);
    }
}
