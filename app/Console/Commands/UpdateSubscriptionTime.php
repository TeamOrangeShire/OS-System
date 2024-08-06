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
            $history = HybridProsHistory::where('hp_id', $hp->hp_id)->where('hp_active_status', 1)->first();

            if($history){
                $deduct = $this->CalcDeductTime($history->hp_remaining_time);

                if($deduct[0] == 0 && $deduct[1] == 0){
                   $history->update([
                    'hp_remaining_time' => '0:0',
                    'hp_active_status'=> 0
                   ]);
                }else{
                    $history->update([
                        'hp_remaining_time' => $deduct[0].':'.$deduct[1],
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
    private function CalcDeductTime($time){
      $split = explode(':', $time);

      $hours = $split[0];
      $minutes = $split[1];

      if($minutes - 1 < 0){
        $finalHours = $hours - 1;
        $finalMinutes = 60 - 1;
      }else {
        $finalHours = $hours;
        $finalMinutes = $minutes - 1;
      }

      return [$finalHours, $finalMinutes];
    }
}
