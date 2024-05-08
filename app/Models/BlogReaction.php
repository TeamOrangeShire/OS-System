<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogReaction extends Model
{
    use HasFactory;
         protected $table = 'blog_reactions';
    protected $primaryKey = 'blog_r_id';
    protected $fillable = [
      'blog_id',
      'customer_id',
      'blog_reaction',
    ];
}
