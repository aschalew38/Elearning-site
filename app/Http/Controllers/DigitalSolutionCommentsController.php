<?php

namespace App\Http\Controllers;

use App\Models\DigitalSolution;
use App\Models\DigitalSolutionComments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DigitalSolutionCommentsController extends Controller
{
    function store(DigitalSolution $DigitalSolution, User $user=null, Request $request){
        // $this->authorize("comments");
        $comment=$request->validate(["content"=>"required"]);
        $comment['user_id']=Auth::user()->id;
        $comment['digital_solution_id']=$DigitalSolution->id;
        if($com=DigitalSolutionComments::firstOrCreate($comment))
        {
            return redirect()->route("digitalSolution.show",['digitalSolution'=>$DigitalSolution->id])->with("success","Thanks for Comments");
        }
        return redirect()->back();


    }
}
