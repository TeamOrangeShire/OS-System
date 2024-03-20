<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResTime extends Model
{
    use HasFactory;

    protected $table = 'res_time';
    protected $primaryKey = 'res_id';
    protected $fillable = [
      'r_time',
      'r_suffix',
    ];

}
