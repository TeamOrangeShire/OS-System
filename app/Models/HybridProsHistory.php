<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HybridProsHistory extends Model
{
    use HasFactory;
    protected $table = 'hybridpros_history';
    protected $primaryKey = 'hph_id';
    protected $fillable = [
        'hp_id',
        'service_id',
        'hp_plan_start',
        'hp_plan_expire',
        'hp_plan_expire_new',
        'hp_remaining_time',
        'hp_consume_time',
        'hp_inuse_status',
        'hp_active_status',
        'hp_payment_status',
        'hp_payment_mode',
    ];
}
