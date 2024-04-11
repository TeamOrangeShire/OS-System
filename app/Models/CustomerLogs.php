<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLogs extends Model
{
    use HasFactory;
    protected $table = 'customer_logs';
    protected $primaryKey = 'log_id';
    protected $fillable = [
      'customer_id',
      'log_date',
      'log_start_time',
      'log_end_time',
      'log_status',
      'log_transaction',
    ];
}
