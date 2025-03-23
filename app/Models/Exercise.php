<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
    public function questions()
    {
        return $this->hasMany(ExerciseQuestion::class);
    }
    public function get_Questions($type)
    {
        return $this->questions()
            ->with('exercise_options')
            ->where('type', $type);
        //   $mcQuestions = ExerciseQuestion::with("exercise_options")->where("exercise_id",$exercise->id)->where("type",$type)->get();
        //     return $mcQuestions;
    }
    public function  course(){

dd($this);
    }

}
