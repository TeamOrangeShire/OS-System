<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAcc extends Model
{
    use HasFactory;
    protected $table = 'admin_acc';
    protected $primaryKey = 'admin_id';
    protected $fillable = [
      'admin_firstname',
      'admin_middlename',
      'admin_lastname',
      'admin_ext',
      'admin_username',
      'admin_password',
      'admin_profile_pic',
      'admin_type',
      'admin_status'
    ];
}
