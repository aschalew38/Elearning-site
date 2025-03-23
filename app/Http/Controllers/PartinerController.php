<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\OrganizationType;
use App\Models\Partiner;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartinerController extends Controller
{
    function  index(){
        $partners=Partner::orderBy("created_at","DESC")->paginate(10);

        return view("partner.index",compact('partners'));
    }
    function partner(){
        $partners=Partner::paginate(10);
        $office_types=OrganizationType::all();
        return view("partner.guest_index",compact("office_types","partners"));
    }
    function create(){
        // $this->authorize("partner_create");
        $office_types=OrganizationType::all();
        return view("partner.create",compact('office_types'));
    }
    function store(Request $request){

        $data=$request->validate([
            "name"=>"required|string",
            "organization_type_id"=>"required",
            "email"=>"nullable|email",
            "phone"=>"nullable|string",
            "url"=>"nullable|string",
            "objective"=>"nullable|string",
            "description"=>"nullable|string",
            "success"=>"nullable|string"
        ]);
        // $request->locations;
        $data['locations']=json_encode(explode("; ", $request->location));
        // dd(explode("; ", $request->location));
        $paths = $request->file("logo")->store("Logos");
        $data['logo']=$paths;
        // dd($data);
        $partner=Partner::firstOrCreate($data);
        if($partner)
            return redirect()->route("partner.index")->with("success","Successfully created");
        return back()->with("error","unable to create");
    }
    function show(Partner $partner){

    return view("partner.show",compact('partner'));

    }
}
