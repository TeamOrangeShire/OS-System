<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HybridHistoryLogs extends Model
{
    use HasFactory;
    protected $table = 'hybrid_history_logs';
    protected $primaryKey = 'log_id';
    protected $fillable = [
        'hph_id',
        'log_date',
        'log_time_in',
        'log_time_out',
        'log_time_consume',
        'log_time_remaining',
        'log_status',
    ];
}
