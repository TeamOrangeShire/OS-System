<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogData extends Controller
{
    public function AddBlog(Request $request)
    {   if($request->title == ''|| $request->content == ''){
         return response()->json(['data' => 'empty']);
    }else{
         $data = new Blog;
        $data->blog_title = $request->title;
        $data->blog_content = $request->content;
        $data->blog_category = $request->category;
        $data->save();
        return response()->json(['data' => $request->content]);
    }
       
    }
    public function GetBlog(){
         $blog = Blog::All();

         return response()->json(['data' => $blog ]);
    }
}
