<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Course;
use App\Models\Exercise;
use App\Models\ExerciseAnswer;
use App\Models\ExerciseOption;
use App\Models\ExerciseQuestion;
use App\Models\Resource;
use App\Models\Section;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Symfony\Component\Console\Question\Question;

class ExerciseController extends Controller
{
    public function index(Resource $resource)
    {
    }
    public function create(Resource $resource)
    {
        return view('Elearning.Course.Resource.create', compact('resource'));
    }
    public function store(Request $request, Resource $resource)
    {

        // dd($request);
        if (!($request->tfquestions || $request->mcquestions||$request->bsquestions)) {
            return back()->with("error", "please add atleast one question");
        }
        $exercise = Exercise::create([
            "resource_id" => $resource->id,
            "name" => $request->name,
        ]);

        if (!$exercise) {
            return back()->with("error", "cannot create exersise");
        }

        if ($request->tfquestions) {
            foreach ($request->tfquestions as $tfQuestions) {
                $first_option = $tfQuestions['answer'];
                $second_option = !settype($tfQuestions['answer'], 'boolean');

                $question = ExerciseQuestion::create(
                    [
                        "exercise_id" => $exercise?->id,
                        "type" => Constants::TF_CODE,
                        "question" => $tfQuestions['question'],
                    ]
                );
                $Option1 = ExerciseOption::create([
                    "exercise_question_id" => $question?->id,
                    "content" => $first_option,
                ]);
                $Option2 = ExerciseOption::create([
                    "exercise_question_id" => $question?->id,
                    "content" => $second_option ? "True" : "False",
                ]);
                $answer = ExerciseAnswer::create([
                    "exercise_question_id" => $question->id,
                    "exercise_option_id" => $Option1?->id,
                ]);
            }
        }

 if ($request->bsquestions) {
            foreach ($request->bsquestions as $bsQuestions) {
                $first_option = $bsQuestions['answer'];
                $second_option = !settype($tfQuestions['answer'], 'boolean');

                $question = ExerciseQuestion::create(
                    [
                        "exercise_id" => $exercise?->id,
                        "type" => Constants::BS_CODE,
                        "question" => $tfQuestions['question'],
                    ]
                );
                $Option1 = ExerciseOption::create([
                    "exercise_question_id" => $question?->id,
                    "content" => $first_option,
                ]);
                $answer = ExerciseAnswer::create([
                    "exercise_question_id" => $question->id,
                    "exercise_option_id" => $Option1?->id,
                ]);
            }
        }


//multiple choice
        if ($request->mcquestions) {
            foreach ($request->mcquestions as $mc_questions) {
                $question = ExerciseQuestion::create(
                    [
                        "exercise_id" => $exercise?->id,
                        "type" => Constants::MC_CODE,
                        "question" => $mc_questions['question'],
                    ]
                );
                $answer = null;
                //insert option A
                $Option1 = ExerciseOption::create([
                    "exercise_question_id" => $question?->id,
                    "content" => $mc_questions['A'],
                ]);
                //insert option B
                $Option2 = ExerciseOption::create([
                    "exercise_question_id" => $question?->id,
                    "content" => $mc_questions['B'],
                ]);
                //insert option C
                $Option3 = ExerciseOption::create([
                    "exercise_question_id" => $question?->id,
                    "content" => $mc_questions['C'],
                ]);
                //insert option D
                 $Option4 =null;
                  if ($mc_questions['D']) {
                $Option4 = ExerciseOption::create([
                    "exercise_question_id" => $question?->id,
                    "content" => $mc_questions['D'],
                ]);}
                //insert option E if exist
                $Option5=null;
                if ($mc_questions['E']) {
                    $Option5 = ExerciseOption::create([
                        "exercise_question_id" => $question?->id,
                        "content" => $mc_questions['E'],
                    ]);

                }
                $this->fill_answer($question?->id, $mc_questions['answer'], $Option1?->id, $Option2?->id, $Option3?->id, $Option4?->id, $Option5?->id);
            }
        }
        return redirect()->route("course.show", ["course" => $resource?->Section?->course?->id])->with("success", "Exercise Created Successfuly");

    }
    public function fill_answer($q, $answ, $a1 = null, $a2 = null, $a3 = null, $a4 = null, $a5 = null)
    {
        $answer_id = null;
        switch ($answ) {
            case "A":{
                    $answer_id = $a1;
                    break;
                }
            case "B":{
                    $answer_id = $a2;
                    break;
                }
            case "C":{
                    $answer_id = $a3;
                    break;
                }
            case "D":{ $answer_id = $a4;
                    break;}
            case "E":{ $answer_id = $a5;
                    break;}

        }
         $answer = ExerciseAnswer::create([
                    "exercise_question_id" => $q,
                    "exercise_option_id" => $answer_id,
                ]);
    }
public function get_Questions(Exercise $exercise,$type){

      $mcQuestions = ExerciseQuestion::with("exercise_options")->where("exercise_id",$exercise->id)->where("type",$type)->get();
        return $mcQuestions;
}

    public function show(Course $course, Section $section, Resource $resource, Exercise $exercise)
    {

        if($course->Instructor_id==auth()->user()->id)

        {

        $tfQuestions = $exercise->get_Questions(Constants::TF_CODE)->get();
        // dd($tfQuestions->get()[0]->exercise_answer->exercise_option->content);
        // $tfQuestions = $this->get_Questions(Constants::TF_CODE);
        // dd($tfQuestions);
        $mcQuestions=$exercise->get_Questions(Constants::MC_CODE)->get();
        $bsQuestions=$exercise->get_Questions(Constants::BS_CODE)->get();
        return view("Elearning.Course.Exercise.show", compact('tfQuestions', 'mcQuestions','bsQuestions', 'exercise'));
        }
        $tfQuestions = ExerciseQuestion::where("exercise_id", $exercise->id)->where("type", Constants::TF_CODE)->get();
        $mcQuestions = ExerciseQuestion::with("exercise_options")->where("exercise_id", $exercise->id)->where("type", Constants::MC_CODE)->get();
        return view("Elearning.Course.Exercise.show", compact('tfQuestions', 'mcQuestions', 'exercise'));
    }
    public function submit_answer(Request $request,Exercise $exercise)
    {
// dd($request);
        $True_False=array([True,False]);
        $all_answers=[];
        foreach($request->all() as $id=>$answers){
            if($id=="_token")
            continue;
            // dump($id);
            $question_type=ExerciseQuestion::where("id",$id)->select("type")->first()->type;
            // dump($question_type);

            if( $question_type == Constants::TF_CODE)
            {
                dump("pass");
                $qs=ExerciseOption::where("exercise_question_id",$id)->where("content",$answers)->first()->id;
                // dd($qs);
                array_push($all_answers,[
                    "exercise_option_id"=>$qs,
                    "exercise_question_id"=>$id,
                    "user_id"=>auth()->user()->id
                ]);
            }
            elseif($question_type == Constants::BS_CODE){
                dump($answers);
                dd("sdjkfldghfg");

            }
            else{
        array_push($all_answers,[
                    "exercise_option_id"=>$answers,
                    "exercise_question_id"=>$id,
                    "user_id"=>auth()->user()->id
                ]);
            }
        }
        dd($all_answers);
       StudentAnswer::insert($all_answers);
    //    return redirect()->route("show_result",["exercise"=>$exercise])->with("success","submited");

}
public function show_result(Exercise $exercise){
 $tfQuestions = $exercise->get_Questions(Constants::TF_CODE)->get();
        $mcQuestions=$exercise->get_Questions(Constants::MC_CODE)->get();
        $bsQuestions=$exercise->get_Questions(Constants::BS_CODE)->get();
        return view("Elearning.Course.Exercise.show_result", compact('tfQuestions', 'mcQuestions','bsQuestions', 'exercise'));


}
}
