<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellationReasons extends Model
{
    use HasFactory;
    protected $table = 'cancellation_reasons';
    protected $primaryKey = 'reason_id';
    protected $fillable = [
        'reason_header',
        'reason_message',
        'reason_type'
    ];
}
