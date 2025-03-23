<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Answer;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentUser;
use App\Models\Course;
use App\Models\CourseAssessment;
use App\Models\Key;
use App\Models\Question;
use App\Models\QuestionKey;
use App\Models\Resource;
use App\Models\ResourceAssessment;
use App\Models\Section;
use App\Models\SectionAssessment;
use App\Models\StudentAnswer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
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
    public function create(Resource $resource)
    {
        return view('Elearning.Course.Resource.create', compact('resource'));
    }
    public function add_exam(Course $course)
    {
        // dd($course);
        return view('Elearning.Course.create_exam', compact('course'));
    }
    public function add_test(Course $course)
    {
        $sections = $course->Sections;
        // dd($sections);
        return view('Elearning.Course.create_test', compact('course', "sections"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Resource $resource = null)
    {

        // dd($resource);
        if (!($request->tfquestions || $request->mcquestions || $request->bsquestions)) {
            return back()->with("error", "please add atleast one question");
        }
        $assement = Assessment::create([
            "name" => $request->name,
            "type" => Constants::ASSESSMENT_TYPE_EXERCISE,
        ]);
        if (!$assement) {
            return response()->back()->with("error", "cannot create Assessment");
        }
        $R_S = ResourceAssessment::create(["assessment_id" => $assement->id, "resource_id" => $resource->id]);

        if (!$R_S) {
            $assement->delete();
            return response()->back()->with("error", "cannot create Assessment");
        }
        $this->save_assessment($request, $assement);

        return redirect(route("course.show", ["course" => $resource?->Section?->course?->id]))->with("success", "Exercise Created Successfuly");

    }
    public function fill_answer($answ, $a1 = null, $a2 = null, $a3 = null, $a4 = null, $a5 = null)
    {
        switch ($answ) {
            case "A":{return $a1;}
            case "B":{return $a2;}
            case "C":{return $a3;}
            case "D":{return $a4;}
            case "E":{return $a5;}
        }
        return null;

    }
    public function save_assessment(Request $request, Assessment $assement)
    {
        $assement_question = [];
        $question_answer = [];
        $question_keys = [];

        if ($request->tfquestions) {
            $true_option = Key::firstOrCreate(['content' => "True"], ['content' => "True"]);
            $false_option = Key::firstOrCreate(['content' => "False"], ['content' => "False"]);
            foreach ($request->tfquestions as $tfQuestions) {
                $key = $tfQuestions['answer'] == $true_option->content ? $true_option->id : $false_option->id;
                $question = Question::create(
                    [
                        "type" => Constants::TF_CODE,
                        "question" => $tfQuestions['question'],
                        "weight" => 1,
                    ]
                );
                array_push($question_answer, ["question_id" => $question->id, "key_id" => $key]);
                array_push($assement_question, ["question_id" => $question->id, "assessment_id" => $assement->id]);
            }
        }

        if ($request->bsquestions) {
            foreach ($request->bsquestions as $bsQuestions) {
                // dd($bsQuestions);
                $question = Question::create(
                    [
                        "type" => Constants::BS_CODE,
                        "question" => $bsQuestions['question'],
                        "weight" => 1,
                    ]
                );
                $q_key = Key::create(["content" => $bsQuestions['answer']]);
                array_push($question_answer, ["question_id" => $question->id, "key_id" => $q_key->id]);
                array_push($assement_question, ["question_id" => $question->id, "assessment_id" => $assement->id]);
            }
        }

//multiple choice
        if ($request->mcquestions) {
            foreach ($request->mcquestions as $mc_questions) {
                $question = Question::create(
                    [
                        "type" => Constants::MC_CODE,
                        "question" => $mc_questions['question'],
                    ]
                );
                $Option1 = Key::create(["content" => $mc_questions['A']]);
                array_push($question_keys, ["question_id" => $question->id, "key_id" => $Option1?->id]);
                $Option2 = Key::create(["content" => $mc_questions['B']]);
                array_push($question_keys, ["question_id" => $question->id, "key_id" => $Option2?->id]);
                $Option3 = Key::create(["content" => $mc_questions['C']]);
                array_push($question_keys, ["question_id" => $question->id, "key_id" => $Option3?->id]);
                $Option4 = null;
                if ($mc_questions['D']) {
                    $Option4 = Key::create(["content" => $mc_questions['D']]);}
                array_push($question_keys, ["question_id" => $question->id, "key_id" => $Option4?->id]);
                $Option5 = null;
                if ($mc_questions['E']) {
                    $Option5 = Key::create(["content" => $mc_questions['E']]);
                    array_push($question_keys, ["question_id" => $question->id, "key_id" => $Option5?->id]);
                }
                $answer_id = $this->fill_answer($mc_questions['answer'], $Option1?->id, $Option2?->id, $Option3?->id, $Option4?->id, $Option5?->id);
                array_push($question_answer, ["question_id" => $question->id, "key_id" => $answer_id]);
                array_push($assement_question, ["question_id" => $question->id, "assessment_id" => $assement->id]);

            }
            QuestionKey::insert($question_keys);
        }
        Answer::insert($question_answer);
        AssessmentQuestion::insert($assement_question);

    }
    public function store_exam(Request $request, Course $course)
    {

        if (!($request->tfquestions || $request->mcquestions || $request->bsquestions)) {
            return back()->with("error", "please add atleast one question");
        }
        $assement = Assessment::create([
            "name" => $request->name,
            "type" => Constants::ASSESSMENT_TYPE_EXAM,
        ]);
        if (!$assement) {
            return response()->back()->with("error", "cannot create Assessment");
        }
        $R_S = CourseAssessment::create(["assessment_id" => $assement->id, "course_id" => $course->id]);

        if (!$R_S) {
            $assement->delete();
            return response()->back()->with("error", "cannot create Assessment");
        }
        $this->save_assessment($request, $assement);

        return redirect(route("course.show", ["course" => $course->id]))->with("success", "Exam Created Successfuly");

    }
    public function store_Test(Request $request, Course $course)
    {
        if (!($request->tfquestions || $request->mcquestions || $request->bsquestions)) {
            return back()->with("error", "please add atleast one question");
        }
        $assement = Assessment::create([
            "name" => $request->name,
            "type" => Constants::ASSESSMENT_TYPE_TEST,
        ]);
        if (!$assement) {
            return response()->back()->with("error", "cannot create Assessment");
        }
        $R_S = SectionAssessment::create(["assessment_id" => $assement->id, "section_id" => $request->section_id]);
        if (!$R_S) {
            $assement->delete();
            return response()->back()->with("error", "cannot create Assessment");
        }
        $this->save_assessment($request, $assement);

        return redirect(route("course.show", ["course" => $course->id]))->with("success", "Test Created Successfuly");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource = null, Assessment $assessment)
    {
        $tfQuestions = $assessment->tfQuestions();
        $bsQuestions = $assessment->bsQuestions();
        $mcQuestions = $assessment->mcQuestions();
        $exercise = $assessment;
        // dd($exercise);
        if ($assessment->type == Constants::ASSESSMENT_TYPE_EXERCISE) {

            $course = $assessment->resourceAssessment[0]->resource->section->course;
            // dump($course);
        } else if ($assessment->type == Constants::ASSESSMENT_TYPE_TEST) {

            $course = $assessment->SectionAssessments[0]->section->course;
            // dump($course);
        } else {

            $course = $assessment->courseAssessments[0]->course;
            $status = $course->assessmentCompleted(auth()->user());

            if(!$status){
                return view("Elearning.Classes.complete_assessment",compact('course'));
            }
            $result=AssessmentUser::where("assessment_id",$assessment->id)->where("user_id",auth()->user()->id)->where("status","completed")->first();
            if($result?->count()>0){
                // dd("tfQuestions");
                // dd($result);
                $this->calculateResult($assessment, auth()->user());
// dd($course);

                return view("Elearning.Course.Assessment.result", compact('assessment', 'result','tfQuestions', 'mcQuestions', 'bsQuestions','course'));
            }
        }

        $user = Auth::user();

        $enrolled_course = $user->enrolled_courses();
        if ($user->id === $course->Instructor_id) {
            return view("Elearning.Course.Assessment.show_ins_v", compact('tfQuestions', 'mcQuestions', 'bsQuestions', 'assessment'));
        }

        return view("Elearning.Course.Assessment.show", compact('tfQuestions', 'enrolled_course', 'mcQuestions', 'bsQuestions', 'assessment'));

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

    public function submit_answer(Assessment $assessment, Request $request)
    {

        $True_False = array([true, false]);
        $all_answers = array();
        $result = 0;
        // dd($request);
        foreach ($request->all() as $id => $answer) {
            // dump($answer);
            if ($id == "_token") {
                continue;
            }
            $question = Question::where("id", $id)->first();
            $question_type = $question->type;
            if ($question_type == Constants::TF_CODE) {
                $qs = Key::where("content", $answer)->first()->id;
                array_push($all_answers, [
                    "key_id" => $qs,
                    "question_id" => $id,
                    "user_id" => auth()->user()->id,
                ]);
                if ($question->answer->id == $qs) {
                    $result += $question->weight;
                }

            } elseif ($question_type == Constants::BS_CODE) {


                if ($answer) {
                    $key_s = Key::firstOrCreate(["content" => $answer]);
                    array_push($all_answers, [
                        "key_id" => $key_s->id,
                        "question_id" => $id,
                        "user_id" => auth()->user()->id,
                    ]);
                    if ($question->answer->key->content == $answer) {
                        $result += $question->weight;
                    }

                }

            } else {
                array_push($all_answers, [
                    "key_id" => $answer,
                    "question_id" => $id,
                    "user_id" => auth()->user()->id,
                ]);

                if ($question->answer->id == $answer) {
                    $result += $question->weight;
                }
            }
        }
        $ss = AssessmentUser::updateOrCreate(
            [
                "user_id" => auth()->user()->id,
                "assessment_id" => $assessment->id,
            ],
            [
                "user_id" => auth()->user()->id,
                "assessment_id" => $assessment->id,
                "result" => $result,
                "status" => "completed",
            ]
        );

        $notCompleted=0;
        $course=$assessment?->course();
        $assessments = $course?->assessments();
        if($assessments?->count()>0)
        foreach ($assessments as $assessment) {
            if (!$assessment->completed)
            $notCompleted ++;
                // return back()->with("error", "please completed assessments first");
        }
        if($notCompleted==0){
            $enroll = $course?->EnrollInfo();
            if($enroll){

                $enroll->completed_date=Carbon::now();
                $enroll->save();
            }
        }

        StudentAnswer::insert($all_answers);
        if ($assessment->type == Constants::ASSESSMENT_TYPE_EXAM) {
            $completed = $this->allAssessment($assessment->CourseAssessments[0]->course, auth()->user());
            if ($completed) {
                return redirect()->route("certificate", ["course" => $assessment->CourseAssessments[0]->course, "user" => auth()->user()]);
            }
        }
        return redirect()->route("show_result", ["assessment" => $assessment])->with("success", "submited");

    }
    public function allAssessment(Course $course, User $user)
    {


        return true;

    }
    public function generateCertificate(){



    }
    public function show_result(Assessment $assessment)
    {

        // dd($assement);
        $tfQuestions = $assessment->tfQuestions();
        $bsQuestions = $assessment->bsQuestions();
        $mcQuestions = $assessment->mcQuestions();
        $this->calculateResult($assessment, auth()->user());
        $result = AssessmentUser::where("assessment_id", $assessment->id)->where("user_id", auth()->user()->id)->first();
        if ($result?->result == 0) {

            $result = AssessmentUser::where("assessment_id", $assessment->id)->where("user_id", auth()->user()->id)->first();
        }
// dd($result);
$course = $assessment->resourceAssessment[0]->resource->section->course;

        return view("Elearning.Course.Assessment.result", compact('course','assessment', 'result','tfQuestions', 'mcQuestions', 'bsQuestions'));
    }
    public function calculateResult(Assessment $assessment, User $user)
    {

        $result = 0;
        // dump($user->id);
        foreach ($assessment->tfQuestions() as $ass_bs) {
            // dump($ass_bs);
            $student_answer = StudentAnswer::where("question_id", $ass_bs->id)->where("user_id", $user->id)->get();

            if ($student_answer[0]->key_id == $ass_bs->answer->key_id) {
                $result += $ass_bs->weight;

            }

        }
        foreach ($assessment->mcQuestions() as $ass_bs) {
            // dump($ass_bs);
            $student_answer = StudentAnswer::where("question_id", $ass_bs->id)->where("user_id", $user->id)->get();

            if ($student_answer[0]->key_id == $ass_bs->answer->key_id) {
                $result += $ass_bs->weight;

            }

        }
        foreach ($assessment->bsQuestions() as $ass_bs) {

            $student_answer = StudentAnswer::where("question_id", $ass_bs->id)->where("user_id", $user->id)->leftjoin("keys", "student_answers.key_id", "keys.id")->get();

            // dump($student_answer[0]->content);
            // dump($ass_bs->answer->key->content);
            // dump("______________");
            if (strtolower($student_answer[0]->content) == strtolower($ass_bs->answer->key->content)) {
                $result += $ass_bs->weight;

            }


        }
        AssessmentUser::updateOrCreate(["assessment_id" => $assessment->id, "user_id" => $user->id], ["assessment_id" => $assessment->id, "user_id" => $user->id, "result" => $result, "status" => "completed"]);

    }
}
