<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::whereNot('status', 'Removed')->paginate(10);
        return view('News.index', compact('news'));
    }

    function index_guest($id=null) {

        $news = News::whereNot('status', 'Removed')->orderBy("created_at","DESC")->paginate(10);
        $current_news=$id?News::where("id",$id)->first():$news[0];
        return view('Front.Pages.News', compact('news',"current_news"));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = null;
        return view('news.create', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (
            auth()
                ->user()
                ->cannot('course.store')
        ) {
            abort(403);
        }
        $data = $request->validate([
            'title' => 'required|string',
            'headline' => 'required',
            'body' => 'required',
        ]);

        $data['posted_by'] = auth()->user()->id;
        $data['status'] = 'Active';

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters');
        }
        News::create($data);
        return redirect()
            ->route('news.index')
            ->with('success', 'Sucessfully Posted,');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }

    public function deactivate(News $news)
    {
        if (Auth::user()->cannot('news.deactivate')) {
            abort(403);
        }

        $news->status = 'Removed';
        $news->save();
        return redirect()
            ->route('news.index')
            ->with('success', 'Successfully Removed from post');
    }
}