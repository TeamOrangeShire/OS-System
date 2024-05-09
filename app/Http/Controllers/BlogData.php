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
     if($request->image == '6.png'){
          $imageName = '6.png';
     }else{
          $request->validate([
               'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
           ]);
           $imageName = time().'.'.$request->image->extension();  
           $request->image->move(public_path('User/Admin/'), $imageName);
     }
   
        $data = new Blog;
        $data->blog_title = $request->title;
        $data->blog_content = $request->content;
        $data->blog_category = $request->category;
        $data->blog_picture = $imageName;
        $data->save();
        return response()->json(['data' => $request->content]);
    }
       
    }
    public function GetBlog(){
     $blogs = Blog::orderBy('blog_id', 'desc')->get();


         return response()->json(['data' => $blogs ]);
    }
    public function GetBlogEdit(Request $request){
     $blog = Blog::where('blog_id',$request->blog_id)->get();

     return response()->json(['data' => $blog ]);
}
public function EditBlog(Request $request){
     $request->validate([
          'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
      ]);
      $imageName = time().'.'.$request->image->extension();  
      $request->image->move(public_path('User/Admin/'), $imageName);

     $edit = Blog::where('blog_id',$request->blog_id)->first();
     $edit->update([
          'blog_title'=>$request->title,
          'blog_category'=>$request->category,
          'blog_content'=>$request->content,
          'blog_picture'=>$imageName,
     ]);
     return response()->json(['data' => $request->content ]);
}
}
