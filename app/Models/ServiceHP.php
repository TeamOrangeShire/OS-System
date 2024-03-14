<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHP extends Model
{
    use HasFactory;
    protected $table = 'service_hp';
    protected $primaryKey = 'service_id';
    protected $fillable = [
     'service_name',
     'service_hours',
     'service_price',
     'promo_id',
     'promo_disable',
    ];
}
