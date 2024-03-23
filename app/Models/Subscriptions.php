<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;
    protected $table = 'subscriptions';
    protected $primaryKey = 'sub_id';
    protected $fillable = [
        'customer_id',
        'service_id',
        'sub_start',
        'sub_end',
        'sub_time',
        'sub_status',
        'sub_cancel_reason',
        'updated_at',
    ];
}
