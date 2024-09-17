<?php

namespace App\Console\Commands;

use App\Models\HybridProsHistory;
use App\Models\HybridProsModel;
use Illuminate\Console\Command;
use Carbon\Carbon;
class CheckExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate a subscription once the current date matches the expiration date of the subscription';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $customer = HybridProsModel::all();
        $date = Carbon::now()->setTimezone('Asia/Hong_Kong');
        foreach($customer as $cust){
          $history = HybridProsHistory::where('hp_id', $cust->hp_id)->get();

          foreach($history as $hist){

            if ($hist->hp_plan_expire_new == null) {
                $expireDate = Carbon::parse($hist->hp_plan_expire)->addDay(); // add one day to the expiration date
                if ($date->gte($expireDate)) {
                    $hist->update([
                        'hp_active_status' => 0
                    ]);
                    $this->info('Deactivated ID: ' . $hist->hph_id);
                }
            } else {
                $expireDate = Carbon::parse($hist->hp_plan_expire_new)->addDay(); // add one day to the expiration date
                if ($date->gte($expireDate)) {
                    $hist->update([
                        'hp_active_status' => 0
                    ]);
                    $this->info('Deactivated ID: ' . $hist->hph_id);
                }
            }
          }
        }
    }
}
