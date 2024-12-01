<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model{
    use HasFactory;

    protected $primaryKey = 'district_id';

    protected $fillable = [
        'district_name',
        'division_id',
    ];

    public function divisionInfo(){
        return $this->belongsTo('App\Models\Division','division_id','division_id');
    }
}
