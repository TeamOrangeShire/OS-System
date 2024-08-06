<?php

namespace App\Console\Commands;

use App\Models\HybridProsHistory;
use App\Models\HybridProsModel;
use Illuminate\Console\Command;

class UpdateSubscriptionTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-subscription-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reduce the time of each active subscription per minute';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hpros = HybridProsModel::all();

        foreach($hpros as $hp){
            $history = HybridProsHistory::where('hp_id', $hp->hp_id)->where('hp_active_status', 1)->where('hp_inuse_status', 1)->first();

            if($history){
                $deduct = $this->CalcDeductTime($history->hp_remaining_time);
                $add = $this->AddMinutesToTime($history->hp_consume_time, 1);
                if($deduct[0] == 0 && $deduct[1] == 0){
                   $history->update([
                    'hp_remaining_time' => '00:00',
                    'hp_active_status'=> 0,
                    'hp_consume_time' => $add[0].":".$add[1]
                   ]);

                }else{
                    $history->update([
                        'hp_remaining_time' => $deduct[0].':'.$deduct[1],
                        'hp_consume_time' => $add[0].":".$add[1]
                    ]);
                }
            }

        }

        $this->info('Done');
    }

    /**
     * Calculate the deducted time.
     *
     * @param int $time
     * @return int
     */
    private function CalcDeductTime($time) {
        $split = explode(':', $time);

        $hours = (int)$split[0];
        $minutes = (int)$split[1];

        if ($minutes - 1 < 0) {
            $finalHours = $hours - 1;
            $finalMinutes = 60 - 1;
        } else {
            $finalHours = $hours;
            $finalMinutes = $minutes - 1;
        }

        $formattedHours = str_pad($finalHours, 2, '0', STR_PAD_LEFT);
        $formattedMinutes = str_pad($finalMinutes, 2, '0', STR_PAD_LEFT);

        return [$formattedHours, $formattedMinutes];
    }

    private function AddMinutesToTime($time, $minutesToAdd) {
        $split = explode(':', $time);

        $hours = (int)$split[0];
        $minutes = (int)$split[1];

        // Add the minutes and handle overflow
        $totalMinutes = $minutes + $minutesToAdd;
        $finalHours = $hours + intdiv($totalMinutes, 60); // Integer division to calculate additional hours
        $finalMinutes = $totalMinutes % 60; // Remainder to get the minutes part

        // Format hours and minutes with leading zeros if necessary
        $formattedHours = str_pad($finalHours, 2, '0', STR_PAD_LEFT);
        $formattedMinutes = str_pad($finalMinutes, 2, '0', STR_PAD_LEFT);

        return [$formattedHours, $formattedMinutes];
    }
}
