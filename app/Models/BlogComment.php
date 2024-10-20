<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;
      protected $table = 'blog_comment';
    protected $primaryKey = 'blog_c_id';
    protected $fillable = [
      'blog_id',
      'customer_id',
      'blog_comment',
    ];
}
