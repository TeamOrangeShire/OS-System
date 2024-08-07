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
        try {
            $hpros = HybridProsModel::all();

            foreach ($hpros as $hp) {
                $history = HybridProsHistory::where('hp_id', $hp->hp_id)
                    ->where('hp_active_status', 1)
                    ->where('hp_inuse_status', 1)
                    ->first();

                if ($history) {
                    try {
                        $deduct = $this->CalcDeductTime($history->hp_remaining_time);
                        $add = $this->AddMinutesToTime($history->hp_consume_time, 1);

                        if ($deduct[0] == 0 && $deduct[1] == 0) {
                            $history->update([
                                'hp_remaining_time' => '00:00',
                                'hp_active_status' => 0,
                                'hp_consume_time' => $add[0] . ":" . $add[1]
                            ]);
                        } else {
                            $history->update([
                                'hp_remaining_time' => $deduct[0] . ':' . $deduct[1],
                                'hp_consume_time' => $add[0] . ":" . $add[1]
                            ]);
                        }

                        $this->info($add[0] . ":" . $add[1]);
                    } catch (\Exception $e) {
                        $this->error("Error updating history for hp_id {$hp->hp_id}: " . $e->getMessage());
                    }
                } else {
                    $this->error("No history found for hp_id {$hp->hp_id}");
                }
            }

            $this->info('Done');
        } catch (\Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
        }
    }

    /**
     * Calculate the deducted time.
     *
     * @param string $time
     * @return array
     */
    private function CalcDeductTime($time) {
        try {
            $split = explode(':', $time);

            if (count($split) !== 2) {
                throw new \Exception("Invalid time format: $time");
            }

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
        } catch (\Exception $e) {
            $this->error("Error calculating deducted time: " . $e->getMessage());
            return ['00', '00']; // Default to zero in case of an error
        }
    }

    private function AddMinutesToTime($time, $minutesToAdd) {
        try {
            $split = explode(':', $time);

            if (count($split) !== 2) {
                throw new \Exception("Invalid time format: $time");
            }

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
        } catch (\Exception $e) {
            $this->error("Error adding minutes to time: " . $e->getMessage());
            return ['00', '00']; // Default to zero in case of an error
        }
    }
}
