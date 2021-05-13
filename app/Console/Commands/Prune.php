<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\BokaKanot\Repositories\BookingRepository;

class Prune extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune (delete) uncompleted bookings';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bookingRepository = new BookingRepository();
        $bookingRepository->pruneSearchBookingsReal();
        $this->comment("Incomplete bookings deleted");
    }
}
