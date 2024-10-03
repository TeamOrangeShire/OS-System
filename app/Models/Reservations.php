<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    protected $table = 'reservations';
    protected $primaryKey = 'r_id';
    protected $fillable = [
      'c_name',
      'start_time',
      'end_time',
      'start_date',
      'end_date',
      'c_email',
      'room_id',
      'c_guest_emails',
      'phone_num',
      'status',
      'reason',
      'billing',
      'pax',
      'request',
      'rate_id',
      'date_cancelled',
      'date_approved',
      'transaction_id'
    ];
}
