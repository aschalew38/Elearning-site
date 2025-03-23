<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogGallery;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs=Blog::all();
        return view("Blog.index",compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Blog.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $user=Auth::user();
        $data=$request->validate([
        "title"=>"required",
            "overview"=>"required",
            "content"=>"required"
        ]);
        $data["user_id"]=$user->id;
        if($request->file('poster')){

            $data['cover'] = $request->file('poster')->store('posters');
        }

        if($blog=Blog::create($data))
        {

            if ($request["gallery"]) {

                $gallery_photos = [];

                foreach ($request->file('gallery') as $gallery) {
                    $path = $gallery['photo']->store('Galleries');
                    array_push($gallery_photos, [
                        'path' => $path,
                        'blog_id' => $blog->id,
                    ]);
                }
                // dd($gallery_photos);
                BlogGallery::insert($gallery_photos);
            }

            return redirect()->route("blogs.index")->withMessage('success',"Blog Added");
        }
        return back()->withMessage("error","Un able to add");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        // dd($blog->comments);
        return view('Blog.blog',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view("Blog.edit",compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $user=Auth::user();
        $data=$request->validate([
        "title"=>"required",
            "overview"=>"required",
            "content"=>"required"
        ]);
        $data["user_id"]=$user->id;
        if($request->file('poster')){

            $data['cover'] = $request->file('poster')->store('posters');
        }
        if($blog->update($data))
        return redirect()->route("blogs.index")->withMessage('success',"Blog Updated");
        return back()->withMessage("error","Un able to add");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route("blogs.index")->withMessage('success',"Blog deleted");
    }
}
