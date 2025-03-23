<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionAssessment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Section()
    {
        return $this->belongsTo(Section::class);
    }
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}