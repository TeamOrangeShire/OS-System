<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('update-subscription-time')->everyMinute();
        $schedule->command('app:check-expiration')->everyMinute();
        // set active
        $schedule->call(function () {
            $reservations = \App\Models\Reservations::where('status', '1')->get();
            foreach ($reservations as $reservation) {
                if (now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($reservation->start_date))) {
                    $reservation->status = '2';
                    $reservation->save();
                }
            }
        })->everyMinute();
        //set complete
        $schedule->call(function () {
            $reservations = \App\Models\Reservations::where('status', '2')->get();
            foreach ($reservations as $reservation) {
                if (now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($reservation->end_date))) {
                    $reservation->status = '3';
                    $reservation->save();
                }
            }
        })->everyMinute(); 
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
