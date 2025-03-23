<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\User;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    function index(){

    }
    function store(Blog $blog,User $user, Request $request){

        $data=$request->validate(["content"=>"required|string"]);
        $data['blog_id']=$blog->id;
        $data['user_id']=$user->id;
        if(BlogComment::create($data))
        return redirect()->route("blogs.show",['blog'=>$blog->id])->with("success","Thanks for you comment");
        return back()->with("error","try later");
    }
}
