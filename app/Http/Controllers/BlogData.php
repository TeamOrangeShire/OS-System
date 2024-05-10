<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogData extends Controller
{
     public function AddBlog(Request $request)
     {
          if ($request->title == '' || $request->content == '') {
               return response()->json(['data' => 'empty']);
          } else {
              $blog_id = RandomId(30);
               $edit = Blog::where('blog_id', $blog_id)->first();
              if(!$edit){
                $blog_id_final = $blog_id;
              }else{
                $blog_id_final = RandomId(30);
              }
               $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
               ]);
               $imageName = time() . '.' . $request->image->extension();
               $request->image->move(public_path('User/Admin/'), $imageName);

               $data = new Blog;
               $data->blog_url_id = $blog_id_final;
               $data->blog_title = $request->title;
               $data->blog_content = $request->content;
               $data->blog_category = $request->category;
               $data->blog_picture = $imageName;
               $data->save();
               return response()->json(['success']);
          }
     }
     public function GetBlog()
     {
          $blogs = Blog::orderBy('blog_id', 'desc')->get();


          return response()->json(['data' => $blogs]);
     }
     public function GetBlogEdit(Request $request)
     {
          $blog = Blog::where('blog_id', $request->blog_id)->get();

          return response()->json(['data' => $blog]);
     }
     public function EditBlog(Request $request)
     {
          $edit = Blog::where('blog_id', $request->blog_id)->first();
          $edit->update([
               'blog_title' => $request->title,
               'blog_category' => $request->category,
               'blog_content' => $request->content,
             
          ]);
          return response()->json(['success']);
     }
     public function DeleteBlog(Request $request)
     {
          $delete = Blog::where('blog_id', $request->blog_id)->first();
          $delete->delete();
          return response()->json(['success']);
     }
     public function UpdateBlogCover(Request $request)
     {    
          $edit = Blog::where('blog_id', $request->blog_id)->first();
         $request->validate([
               'coverpic' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
          ]);
          $imageName = explode('.',$edit->blog_picture)[0] . '.' . $request->coverpic->extension();
          $request->coverpic->move(public_path('User/Admin/'), $imageName);
          
           $edit->update([
               'blog_picture' => $imageName,
          ]);
          return response()->json(['success']);
     }
}
