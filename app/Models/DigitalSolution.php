<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalSolution extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Catagory()
    {
        return $this->belongTo(Catagory::class);
    }
    public function team()
    {
        return $this->hasMany(Team::class);
    }
    public function partners()
    {
        return $this->hasMany(Partner::class);
    }
    public function Lead()
    {
        return $this->partners->where('type', 'Lead');
    }
    public function sponsors()
    {
        return $this->partners->where('type', 'Sponsor');
    }
    public function Implementor()
    {
        return $this->partners->where('type', 'Implementing');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
    public function TargetGroups()
    {
        return $this->hasMany(TargetGroup::class,"digital_solution_id","id");
    }
    public function GeographicAreas()
    {
        return $this->hasMany(GeographicArea::class);
    }
    function  comments(){
        return        $this->hasMany(DigitalSolutionComments::class,"digital_solution_id","id");
    }
    function geographic_areas(){
        return $this->hasMany(GeographicArea::class,"digital_solution_id","id");
    }
}
