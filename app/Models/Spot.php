<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model{
    use HasFactory;

    protected $primaryKey = 'spot_id';

    protected $fillable = [
        'spot_name',
        'spot_division_id',
        'spot_district_id',
        'spot_types_of_attraction_id',
        'spot_details',
        'spot_photo',
        'spot_entry_fee',
        'spot_opening_time',
        'spot_closing_time',
    ];

    public function divisionInfo(){
        return $this->belongsTo('App\Models\Division','spot_division_id','division_id');
    }

    public function districtInfo(){
        return $this->belongsTo('App\Models\District','spot_district_id','district_id');
    }

    public function typesOfAttractionInfo(){
        return $this->belongsTo('App\Models\TypesOfAttraction','spot_types_of_attraction_id','types_of_attraction_id');
    }
}
