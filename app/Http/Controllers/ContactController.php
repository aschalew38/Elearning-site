<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
function store(Request $request){


$message=$request->validate(
    [
        "name"=>"string",
        "email"=>"email",
        "subject"=>"nullable|string",
        "message"=>"required|string"
    ]
);

if(Contact::create($message)){
    return redirect()->route("home")->with("success","Thank You for your message, We reach you soon!!");
}
return back();
}
function index(){
    $this->authorize("contact_list");
    $contacts=Contact::orderBy("created_at","DESC")->paginate(15);
    return view("contact.index",compact("contacts"));
}
}
