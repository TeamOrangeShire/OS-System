<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRates extends Model
{
    use HasFactory;
    protected $table = 'room_rates';
    protected $primaryKey = 'rp_id';
    protected $fillable = [
        'room_id',
        'rp_rate_description',
        'rp_price',
        'rp_disable'
    ];
}
