<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Assessment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function resourceAssessment()
    {
        return $this->hasMany(ResourceAssessment::class);
    }
    public function AssessmentQuestions()
    {
        // dump()
        return $this->hasMany(AssessmentQuestion::class);
    }
    public function tfQuestions()
    {
        return Question::join(
            'assessment_questions',
            'assessment_questions.question_id',
            'questions.id'
        )
            ->where('assessment_questions.assessment_id', $this->id)
            ->where('questions.type', Constants::TF_CODE)
            ->get();
    }
    public function bsQuestions()
    {
        return Question::join(
            'assessment_questions',
            'assessment_questions.question_id',
            'questions.id'
        )
            ->where('assessment_questions.assessment_id', $this->id)
            ->where('questions.type', Constants::BS_CODE)
            ->get();
    }
    public function mcQuestions()
    {
        return Question::join(
            'assessment_questions',
            'assessment_questions.question_id',
            'questions.id'
        )
            ->where('assessment_questions.assessment_id', $this->id)
            ->where('questions.type', Constants::MC_CODE)
            ->get();
    }
    public function courseAssessments()
    {
        return $this->hasMany(CourseAssessment::class);
    }
    public function SectionAssessments()
    {
        return $this->hasMany(SectionAssessment::class);
    }
    public function ResourceAssessments()
    {
        return $this->hasMany(ResourceAssessment::class);
    }
    function questions(){
        return $this->hasMany(AssessmentQuestion::class,"assessment_id");
    }
    public function getWeightAttribute(){

        return         Question::join("assessment_questions","assessment_questions.question_id","questions.id")->where("assessment_questions.assessment_id",$this->id)->sum("questions.weight");


    }
    function assessment_users(){
        return $this->hasMany(AssessmentUser::class,"assessment_id","id");
    }
    function getCompletedAttribute(){

      return  $this->assessment_users->where("user_id",Auth::user()->id)->where("status","completed")->first();
    }
    function course(){
        // return $this->courseAssessments;

    }
}
