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
      'log_date',
      'log_start_time',
      'log_end_time',
      'log_firstname',
      'log_middlename',
      'log_lastname',
      'log_ext',
      'log_email',
      'log_phone_num',
      'log_status',
    ];
}
