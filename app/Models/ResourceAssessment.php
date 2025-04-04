<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceAssessment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}