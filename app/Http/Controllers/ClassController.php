<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Resource;
use App\Models\Section;
use App\Models\vediostatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Section $section, Resource $resource)
    {

        $user = Auth::user();
        $user_id = $user->id;
        $enrolled_course = $user->enrolled_courses();
        return view(
            'Elearning.Classes.show',
            compact('course', 'section', 'resource', 'enrolled_course')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function updateVideo(Request $request)
    {
        $user_id = Auth::user()->id;
        $resource_id = $request->resource_id;
        $videoStatus = vediostatus::where('user_id', $user_id)
            ->where('resource_id', "$resource_id")
            ->first();
        if ($videoStatus->status != 'Completed') {
            $videoStatus->update([
                'viewed_time' => $request->viewed_time,
                'status' => $request->status,
            ]);
        }

        return response()->json(['message', 'Success']);
    }
    public function getVideo(Resource $resource)
    {
        $name = $resource->path;
        // dump($name);
        $fileContents = Storage::disk('local')->get("/{$name}");
        $response = Response::make($fileContents, 200);
        $response->header('Content-Type', 'video/mp4');
        return $response;
    }
}
