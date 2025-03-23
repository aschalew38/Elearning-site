<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function AssessmentQuestion()
    {
        return $this->hasOne(AssessmentQuestion::class);
    }
    public function question_keys()
    {
        return $this->hasMany(QuestionKey::class);
    }
    public function answer()
    {
        return $this->hasOne(Answer::class);
    }
    public function question_answer_Inst()
    {
        // dd($this->answer);
        return $this->answer->key;
    }
    public function getYourAnswerAttribute(){

       return StudentAnswer::where("question_id",$this->id)->where("user_id",Auth::user()?->id)->first()?->key;

    }

}
