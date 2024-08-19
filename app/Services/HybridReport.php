<?php

namespace App\Services;

use App\Models\HybridProsHistory;
use App\Models\HybridProsModel;
use App\Models\ServiceHP;
use Carbon\Carbon;

class HybridReport {


 public function __construct()
 {
   return 0;
 }

  public function getDaily(){
    $sale = HybridProsHistory::whereDate('created_at', Carbon::today())->where('hp_payment_status', 1)->get();
    $this->FilterData($sale);
    return $sale;
  }

  public function getMonthly($month, $year){
    $sale = HybridProsHistory::whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->where('hp_payment_status', 1)
                            ->get();
    $this->FilterData($sale);
    return $sale;
  }

  public function getYearly($year){
    $sale = HybridProsHistory::whereYear('created_at', $year)->where('hp_payment_status', 1)->get();
    $this->FilterData($sale);
    return $sale;
  }

  public function getByDate($date)
  {
      // Ensure $date is a Carbon instance
      $date = Carbon::parse($date)->startOfDay();

      $sale = HybridProsHistory::whereDate('created_at', $date)
                               ->where('hp_payment_status', 1)
                               ->get();

      $this->FilterData($sale);
      return $sale;
  }
  public function getWeekly($weekStart, $weekEnd)
  {
      $start = Carbon::parse($weekStart)->startOfDay();
      $end = Carbon::parse($weekEnd)->endOfDay();

      $sale = HybridProsHistory::whereBetween('created_at', [$start, $end])
                               ->where('hp_payment_status', 1)
                               ->get();
      $this->FilterData($sale);
      return $sale;
  }

  private function FilterData($sale){
    foreach($sale as $s){
        $service = ServiceHP::where('service_id', $s->service_id)->first();
        $customer = HybridProsModel::where('hp_id', $s->hp_id)->first();

        $s->customer_name = $customer->hp_customer_name;
        $s->service_name = $service->service_name;
        $s->ammount = $service->service_price;
      }
  }

}
