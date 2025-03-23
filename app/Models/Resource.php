<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Resource extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function get_student_status()
    {
        $user_id = Auth::user()->id;
        return vediostatus::where("user_id", $user_id)->where("resource_id", $this->id)->select("status")->first()?->status;
    }
    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
    public function resourceAssessments()
    {
        return $this->hasMany(ResourceAssessment::class);
    }
}