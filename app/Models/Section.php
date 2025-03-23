<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Course()
    {
        return $this->belongsTo(Course::class);
    }
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
    public function SectionAssessments()
    {
        return $this->hasMany(SectionAssessment::class);
    }
}