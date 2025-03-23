<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalSolutionGallery extends Model
{
    use HasFactory;
    protected $guarded=[];
    function DigitalSolution(){
        return $this->belongsTo(DigitalSolution::class,"digital_solution_id","id");
    }

}
