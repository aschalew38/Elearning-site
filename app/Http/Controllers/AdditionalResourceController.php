<?php

namespace App\Http\Controllers;

use App\Models\AdditionalResource;
use Illuminate\Http\Request;

class AdditionalResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additional_resources = AdditionalResource::orderBy('created_at','DESC')->paginate(10);
        return view('AdditionResource.index',compact('additional_resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $data=$request->validate([
            "url"=>"required|",
            "overview"=>"nullable|string",
            "type"=>"required",
            "title"=>"nullable|required"
        ]);
        if($request->file('add_resource')){

            $data['url'] = $request->file('add_resource')->store('AdditionalResources');
        }
        if(AdditionalResource::create($data))
        return redirect()->route("additional_resources.index")->with('success',"Resourced Added");
        return back()->withMessage("error","Un able to add");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdditionalResource  $additionalResource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $additional_resources = AdditionalResource::find($id);
        return view('AdditionResource.show_resource',['resource'=>$additional_resources]);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdditionalResource  $additionalResource
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$additional_resources=AdditionalResource::orderBy("created_at","DESC")->paginate(10);
        $additional_resources = AdditionalResource::find($id);
      return view('AdditionResource.edit_resource',['post'=>$additional_resources]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdditionalResource  $additionalResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate(['id'=>'required',
        'url'=>'required','overview'=>'required','title'=>'required','type'=>'required']);
        $data = AdditionalResource::find($request->id);
        $data->url=$request->url;
        $data->title=$request->title;
        $data->overview=$request->overview;
        $data->type=$request->type;
        if($data->save())
        {
            return redirect()->back()->with(['success'=>"updated successfully"]);
        }else{
            return redirect()->back()->with(['error'=>"unable to update"]);
        }
    }

    /**""
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdditionalResource  $additionalResource
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AdditionalResource::find($id);
        if($data->delete())
        {
            return redirect()->back()->with(['success'=>'Deleted successfully']);
        }else{
            return redirect()->back()->with(['error'=>'unable to delete']);
        }
    }
function guest_index(){
    $additional_resources=AdditionalResource::orderBy("created_at","DESC")->paginate(10);
    return view('Front.Pages.resources',compact('additional_resources'));
}
}
