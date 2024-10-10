<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
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
            $current_time = Carbon::now()->format('H:i'); // Get the current time in 'H:i' format

            $reservations = \App\Models\Reservations::where('status', '1')->where('room_id' ,'!=','0')->get();
            foreach ($reservations as $reservation) {
                // Check if the current date is greater than or equal to the reservation start date
                if (
                    now()->greaterThanOrEqualTo(Carbon::parse($reservation->start_date))
                    && $current_time > $reservation->start_time
                    )
                {
                    // If both date and time conditions are met, update the reservation status
                    $reservation->status = '2';
                    $reservation->save();
                }
            }
        })->everyMinute();
        //set complete
        $schedule->call(function () {
            $current_time = Carbon::now()->format('H:i');
            $reservations = \App\Models\Reservations::where('status', '2')->where('room_id', '!=', '0')->get();
            foreach ($reservations as $reservation) {
                if (
                    now()->greaterThanOrEqualTo(Carbon::parse($reservation->end_date))
                    && $current_time>$reservation->end_time
                    ) 
                    {
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
