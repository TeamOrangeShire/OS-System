<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promos extends Model
{
    use HasFactory;
    protected $table = 'promos';
    protected $primaryKey = 'promo_id';
    protected $fillable = [
        'promo_name',
        'promo_percentage',
        'promo_disable',
    ];
}
