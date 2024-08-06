<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HybridProsModel extends Model
{
    use HasFactory;
    protected $table = 'hybridpros';
    protected $primaryKey = 'hp_id';
    protected $fillable = [
        'hp_customer_name',
        'hp_phone_number',
        'hp_email',
        'service_id',
        'hp_plan_start',
        'hp_plan_expire',
        'hp_remaining_time',

        'hp_inuse_status',
        'hp_active_status',
        'hp_payment_status',
        'hp_payment_mode',
    ];
}
