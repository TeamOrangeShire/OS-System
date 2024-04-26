<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $table = 'tour_status';
    protected $primaryKey = 'tour_status';
    protected $fillable = [
        'customer_id',
        'tour_home',
        'tour_login',
        'tour_profile',
        'tour_reservation',
        'tour_subscription',
        'tour_settings',
    ];

}
