<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Section;
use App\Models\vediostatus;
use Illuminate\Http\Request;

class ResourceController extends Controller
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
    public function store(Request $request, Section $section)
    {
    //    dd($request);
        // $request->validate(
        //     ["title"=>]
        // );
        $course = $section->course;
        $enrolled_student = $course
            ->enrolled_students()
            ->get()
            ->pluck('user_id');
        // dd($enrolled_student);
        $data = $request->validate([
            'title' => 'required_without:pdftitle',
            'pdftitle' => 'required_without:title',

        ]);
        if($request['pdftitle'])
            $data['title']=$data['pdftitle'];
        unset($data['pdftitle']);
        $data['section_id'] = $section->id;
        if ($request->hasFile('file')) {
            $data['path'] = $request->file('file')[0]->store('Vedios');
            $resource = Resource::create($data);

            if ($resource) {
                foreach ($enrolled_student as $student_id) {
                    vediostatus::insert([
                        'resource_id' => $resource->id,
                        'user_id' => $student_id,
                    ]);
                }
            } else {
                return back()->with('error', 'can\'t uploaded');
            }

            return back()->with('success', 'successfully uploaded');
        }
        if ($request->hasFile('pdf_resource')) {
            $data['path'] = $request->file('pdf_resource')->store('PDFS');
            $data['content_type']="PDF";
            $resource = Resource::create($data);

            } else {
                return back()->with('error', 'can\'t uploaded');
            }

            return back()->with('success', 'successfully uploaded');
        }
    // }/
// }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
