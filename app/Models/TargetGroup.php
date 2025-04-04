<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetGroup extends Model
{
    use HasFactory;
    public function DigitalSolution()
    {
        return $this->belongsTo(DigitalSolution::class);
    }
}
