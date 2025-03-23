<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\AssessmentUser;
use App\Models\Course;
use App\Models\CourseLike;
use App\Models\Enroll;
use App\Models\User;
use App\Models\vediostatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// use Barryvdh\DomPDF\PDF;
use PDF;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $course = null;
        if (
            $user->hasAnyRole([
                Constants::SUPER_ADMIN_ROLE,
                Constants::ADMIN_ROLE,
            ])
        ) {
            $courses = Course::paginate(10);
        } elseif ($user->hasRole(Constants::TRAINER_ROLE)) {
            $courses = $user->courses;
            // dd($courses[0]->name);
        } else {
            $courses = Course::whereNot('status', 'Pending')->paginate(10);
        }

        return view('Elearning.Course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->authorize("course.create");
        $course = null;
        return view('Elearning.Course.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('course.store');
        $data = $request->validate([
            'name' => 'required|string|unique:courses,name',
            'catagory' => 'string|required',
            'price' => 'nullable',
            'minutes' => 'required',
            'overview' => 'required',
        ]);
        $data['Instructor_id'] = auth()->user()->id;
        $data['status'] = 'Pending';

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters');
        }
        Course::create($data);
        return redirect()
            ->route('course.index')
            ->with(
                'success',
                'Sucessfully Registered, please wait for approval'
            );
    }

    public function activate(Course $course)
    {

        $this->authorize("course.activate");
        $course->status = 'Active';
        $course->save();
        return redirect()
            ->route('course.index')
            ->with('success', 'Successfully Activated');
    }
    function course_certificate(Course $course)
    {
        // $this->authorize("course_certificate");
        // if($course->)
        $data = [
            'title' => 'Laravel PDF Example',
            'date' => date('m/d/Y'),
        ];

        // Load the view and pass the data
        $user = Auth::user();
        $pdf = PDF::loadView('Elearning.cert', compact('course', 'user'));

        // Define a filename for the PDF
        $fileName = 'example_' . time() . '.pdf';

        // Save the PDF to the storage
        $path = storage_path('app/public/' . $fileName);
        $pdf->save($path);
    }
    public function deactivate(Course $course)
    {
        if (Auth::user()->cannot('course.deactivate')) {
            abort(403);
        }
        $course->status = 'Removed';
        $course->save();
        return redirect()
            ->route('course.index')
            ->with('success', 'Successfully Deactivated');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $this->authorize("course.show");

        // if (Auth::user()->cannot('course.show')) {
        //     abort(403);
        // }
        // dd($course->assessments);
        $completed=$course->enrolls->whereNotNull("centificate")->count();
        $active=$course->enrolls->whereNull("centificate")->count();
        // dump($active);
// dd($completed);
        return view('Elearning.Course.show', compact('course','active','completed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        if (Auth::user()->cannot('course.edit')) {
            abort(403);
        }
        return view("Elearning.Course.edit", compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        if (Auth::user()->cannot('course.update')) {
            abort(403);
        }
        $data = $request->validate([
            'name' => 'required|string',
            'catagory' => 'string|required',
            'price' => 'nullable',
            'minutes' => 'required',
            'overview' => 'required',
        ]);
        // $data['Instructor_id'] = auth()->user()->id;
        // $data['status'] = 'Pending';

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters');
        }
        $course->update($data);
        return redirect()
            ->route('course.index')
            ->with(
                'success',
                'Sucessfully Updated'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if (Auth::user()->cannot('course.destory')) {
            abort(403);
        }
    }

    public function enroll(Course $course)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data = [
            'user_id' => $user_id,
            'course_id' => $course->id,
            'progress' => 0,
        ];

        $sections = $course->Sections;
        // dd($sections);
        $add_resource = [];
        $user_assessments = [];
        $courseAssessments = $course->courseAssessments;

        foreach ($sections as $section) {
            //add resource
            $resources = $section->resources;
            $section_assessments = $section->SectionAssessments;
            foreach ($resources as $resource) {
                array_push($add_resource, [
                    'resource_id' => $resource->id,
                    'user_id' => $user_id,
                ]);
                $all_ass = $resource->resourceAssessments;
                foreach ($all_ass as $ass) {
                    array_push($user_assessments, [
                        'user_id' => $user_id,
                        'assessment_id' => $ass->id,
                    ]);
                }
            }

            //add section assessment Here
            foreach ($section_assessments as $section_assessment) {
                array_push($user_assessments, [
                    'user_id' => $user_id,
                    'assessment_id' => $section_assessment->assessment_id,
                ]);
            }
        }
        foreach ($courseAssessments as $courseAssessment) {
            array_push($user_assessments, [
                'user_id' => $user_id,
                'assessment_id' => $courseAssessment->assessment_id,
            ]);
        }
        $class = Enroll::create($data);
        vediostatus::insert($add_resource);
        AssessmentUser::insert($user_assessments);
        // dd($course->Sections->first()->resource);
        $user->assignRole(Constants::STUDENT_ROLE);
        return redirect()
            ->route('resources.show', [
                'course' => $course->id,
                'section' => $course?->Sections->first()?->id,
                'resource' => $course?->Sections->first()?->resources->first()?->id,
            ])
            ->with('success', 'Enrolled');
    }

    public function gotoclass(Course $course)
    {
        $this->authorize("gotoclass");
        $sections = $course->Sections[0];
        $resources = $sections->resources;
        return redirect()->route('resources.show', [
            'course' => $course->id,
            'section' => $sections->id,
            'resource' => $resources[0]->id,
        ]);
    }

    public function certificate(Course $course, User $user = null)
    {

        $user ?? $user = Auth::user();
        $enroll = $course->EnrollInfo();
        if(!$enroll->completed_date){
            $enroll = $course->EnrollInfo();
            $enroll->completed_date=Carbon::now();
        }
        if ($enroll->centificate) {
            $path =  Storage::path('storage/'.$enroll->centificate);
            $name = $user?->name . $course->name . ".pdf";
            $header = array(
                'Content-Type: application/pdf',
            );
            // return response()->download($path, $name, $header);
            // return response()->file(asset($enroll->certificate));
        }
        $assessments = $course->assessments();
        foreach ($assessments as $assessment) {
            if (!$assessment->completed)
                return back()->with("error", "please completed assessments first");
        }

        $logo = 'stm.png';
        $completed = Carbon::parse($enroll->completed_date)->format('d M, Y');
        $pdf = PDF::loadView('Elearning.Course.certificate', compact('completed', 'course', 'user', 'logo'))->setPaper('letter', 'landscape');
        $fileName = 'cert_' . explode(" ",$user->name)[0].$user->id . '_' . $course->id . '.pdf';
        // $filePath = storage_path('storage/centificate/' . $fileName);
        $filePath = 'certificate/' . $fileName;
        $file = Storage::put('certificate/' . $fileName, $pdf->output());
        if ($file) {
            $enroll->centificate = $filePath;
            $enroll->save();
        }
        return $pdf->download($user->name . $course->name . $fileName . '.pdf');

    }
    public function generatePDF($course, $user)
    {

        $logo = asset('BackEnd/assets/images/stm.png');
        $pdf = PDF::loadView('Elearning.Course.certificate', compact('course', 'user', 'logo'));
        return $pdf->download('pdf.pdf');
    }
    function like(Course $course)
    {

        CourseLike::firstOrCreate(["user_id" => Auth::user()->id, "course_id" => $course->id]);
        return back();
    }
    function dislike(Course $course)
    {
        // $course->courseLike->where("user_id",Auth::user()->id)->delete();
        CourseLike::where("course_id", $course->id)->where("user_id", Auth::user()->id)->delete();
        // dd();
        return back();
    }
}
