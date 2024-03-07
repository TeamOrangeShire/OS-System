<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAcc extends Model
{
    use HasFactory;
    protected $table = 'customer_acc';
    protected $primaryKey = 'customer_id';
    protected $fillable = [
      'customer_firstname',
      'customer_middlename',
      'customer_lastname',
      'customer_ext',
      'customer_email',
      'customer_phone_num',
      'customer_username',
      'customer_password',
      'customer_profile_pic',
    ];
}