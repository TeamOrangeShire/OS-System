<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservation';
    protected $primaryKey = 'res_id';
    protected $fillable = [
       'customer_id',
       'room_id',
       'rprice_id',
       'res_date',
       'res_start',
       'res_end',
       'res_notes',
       'res_status',
       'res_disable',
    ];
}
