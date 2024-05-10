<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;

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

              $file = $request->file('image');

        if ($file->getSize() > 10485760) {
            return response()->json([ 'exceed']);
        }else   if (!in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg'])) {
            return response()->json(['invalid_type']);
        }
        else{
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
          $content = $request->content;
          $edit->update([
               'blog_title' => $request->title,
               'blog_content' => $content,
               'blog_category' => $request->category,
               
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
           $file = $request->file('coverpic');

        if ($file->getSize() > 10485760) {
            return response()->json([ 'status'=>'exceed']);
        }else   if (!in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg'])) {
            return response()->json(['status'=>'invalid_type']);
        }
        else{

          $imageName = explode('.',$edit->blog_picture)[0] . '.' . $request->coverpic->extension();
          $request->coverpic->move(public_path('User/Admin/'), $imageName);

           $edit->update([
               'blog_picture' => $imageName,
          ]);
          return response()->json(['success']);
     }

     }
     public function AddNewCategory(Request $request){

                $get = BlogCategory::where('category_name', $request->newcatogory)->first();
                if($get){
                return response()->json(['exist']);
                }else{
               $data = new BlogCategory;
               $data->category_name = $request->newcatogory;
               $data->save();
               return response()->json(['success']);
                }
              
     }
}
