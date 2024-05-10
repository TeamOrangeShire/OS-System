<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
         protected $table = 'blog_category';
    protected $primaryKey = 'blog_c_id';
    protected $fillable = [
      'category_name',
    ];
}
