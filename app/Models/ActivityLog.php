<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $table = 'activity_log';
    protected $primaryKey = 'act_id';
    protected $fillable = [
      'act_user_id',
      'act_user_type',
      'act_action',
      'act_header',
      'act_location',
    ];
}
