<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLogUnregister extends Model
{
    use HasFactory;
    protected $table = 'customer_log_unregister';
    protected $primaryKey = 'unregister_id';
    protected $fillable = [
      'unregister_id',
      'un_firstname',
      'un_middlename',
      'un_lastname',
      'un_ext',
      'un_email',
      'un_number',
      'un_log_date',
      'un_log_start_time',
      'un_log_end_time',
      'un_log_status',
      'un_log_transaction',
    ];
  
}
