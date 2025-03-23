<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;
    // use Rateable, Likeable;
    protected $guarded = [];
    public function Sections()
    {
        return $this->hasMany(Section::class);
    }
    public function enrolled()
    {
        $user = Auth::user();
        return Enroll::where('user_id', $user->id)
            ->where('course_id', $this->id)
            ->count() > 0;
    }
    public function enrolls()
    {
        return $this->hasMany(Enroll::class, "course_id", "id");
    }
    public function EnrollInfo()
    {

        // return $this->enrolls;
        $user = Auth::user();
        return $this->enrolls->where('user_id', $user->id)
            ->where('course_id', $this->id)->first();
    }
    public function owner()
    {
        return User::where('id', $this->Instructor_id)->first();
    }
    public function Instructor()
    {
        return $this->belongsTo(User::class);
    }
    public function enrolled_students()
    {
        return Enroll::where('course_id', $this->id);
    }
    public function courseAssessments()
    {
        return $this->hasMany(CourseAssessment::class);
    }

    public function assessmentCompleted(User $user)
    {
        $exercise = Db::select(
            DB::Raw(
                "SELECT count(*) as num from assessment_users
                where assessment_users.assessment_id in
                (SELECT assessments.id FROM `assessments`
                JOIN resource_assessments on resource_assessments.assessment_id = assessments.id
                JOIN resources on resource_assessments.resource_id = resources.id JOIN sections on sections.id =
                 resources.section_id where sections.course_id={$this->id}) and user_id={$user->id} and status !='completed';"
            )
        )[0]->num;
        // dd($exercise[0]->num);
        $tests = Db::select(
            DB::Raw("
       SELECT count(*) as num from assessment_users where assessment_users.assessment_id in (SELECT assessments.id FROM `assessments` JOIN section_assessments on section_assessments.assessment_id = assessments.id JOIN sections on sections.id = section_assessments.section_id where sections.course_id=1) and user_id=3 and status !='completed';
       ")
        )[0]->num;
        $vedio = DB::select(
            DB::raw(
                "SELECT count(vediostatuses.id) as num FROM `vediostatuses`  JOIN resources on vediostatuses.resource_id= resources.id JOIN sections on sections.id= resources.section_id WHERE sections.course_id=1 and vediostatuses.user_id=3 and vediostatuses.status !='Completed';"
            )
        )[0]->num;
        return $exercise + $tests + $vedio == 0;
    }
    function liked()
    {
        // dump($this->courseLike);
        return $this->courseLike->where("user_id", Auth::user()->id)?->count() > 0;
    }
    function courseLike()
    {
        return $this->hasMany(CourseLike::class);
    }
    function likes()
    {
        // dd($this->courseLike()?->count());
        // return $this->courseLike()->count();
        $liked = $this->courseLike()?->count() ?? 0;
        // $liked=10034;
        if ($liked < 1000)
            return $liked;
        elseif ($liked < 1000000)
            return round($liked / 1000, 2) . "K";
        elseif ($liked < 1000000000)
            return round($liked / 1000000, 2) . "M";
        return round($liked / 1000000000, 2) . "B";
    }
    function getCertifiedAttribute()
    {
        // return True;
        return  $this->certicate ? True : False;
    }
    function Assessments()
    {
        // return $this->through('course_assessments')->has('assessments');
        // return $this->hasMany(CourseAssessment::class);
        return Assessment::join("course_assessments", "course_assessments.assessment_id", "assessments.id")
            ->join("assessment_users", "assessment_users.assessment_id", "assessments.id")
            ->where("assessment_users.user_id", Auth::user()?->id)->where("course_assessments.course_id", $this->id)->get();
        // return $this->hasManyThrough(CourseAssessment::class,Assessment::class,);

    }
    function  getCertifiedStudentsAttribute(){

        return $this->enrolls->whereNotNull("centificate")->count();
    }
    function  getActiveAttribute(){
        return $this->enrolls->whereNull("centificate")->count();

    }
}
