<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Util\Json;

class Partner extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'attributes' => 'json',
    ];
    public function DigitalSolution()
    {
        return $this->belongsTo(DigitalSolution::class);
    }
    function locs(){

        $collect=collect(json_decode(trim($this->locations),true));
        return $collect;
    }
    function organization_type(){
        return $this->belongsTo(OrganizationType::class,"organization_type_id");
    }
}
