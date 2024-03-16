<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRate extends Model
{
    use HasFactory;
    protected $table = 'room_rate';
    protected $primaryKey = 'rate_id';
    protected $fillable = [
      'rate_id',
      'rate_name',
      'rate_price',
      'rate_disable',
      
    ];
}
