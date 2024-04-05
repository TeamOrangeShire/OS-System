<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerNotification extends Model
{
    use HasFactory;
    protected $table = 'customer_notification';
    protected $primaryKey = 'notif_id';
    protected $fillable = [
      'user_id',
      'user_type',
      'notif_header',
      'notif_message',
      'notif_status',
      'notif_label',
      'notif_table',
      'notif_table_id',
    ];
}
