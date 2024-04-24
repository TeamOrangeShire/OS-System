<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnregisterAcc extends Model
{
    use HasFactory;
    protected $table = 'unregister_acc';
    protected $primaryKey = 'un_id';
    protected $fillable = [
       'un_firstname',
       'un_middlename',
       'un_lastname',
       'un_ext',
       'un_email',
       'un_contact',
       'un_type'
    ];
}
