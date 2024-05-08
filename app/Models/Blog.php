<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
     protected $table = 'blog';
    protected $primaryKey = 'blog_id';
    protected $fillable = [
      'blog_title',
      'blog_contant',
      'blog_picture',
      'blog_category',
    ];
}
