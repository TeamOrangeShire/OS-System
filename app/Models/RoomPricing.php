<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPricing extends Model
{
    use HasFactory;
    protected $table = 'room_pricing';
    protected $primaryKey = 'rprice_id';
    protected $fillable = [
      'room_id',
      'room_rates',
      'room_price',
      'promo_id',
      'room_pricing_disable',
    ];
}
