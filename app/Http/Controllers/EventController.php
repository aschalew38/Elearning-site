<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy("created_at","DESC")->paginate(10);
        // dd($events);
        return view("Event.index", compact("events"));
    }
    public function create()
    {
        $this->authorize("event.create");

        return view("Event.create", ['event' => null]);
    }
    function store(Request $request)
    {
        $this->authorize("event.store");
        $data = $request->validate([
            'type' => 'required|string',
            "starting_date"=>"required|date",
            "ending_date"=>"nullable|date",
            "starting_time"=>"required",
            'about' => 'required|string',
            'body' => 'required',
        ]);
        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters');
        }
        if (Event::create($data))
            return redirect()->route("event.index")->with("success", "Successfully Uploaded");
        return back()->with("error", "un able to create");
    }
}
