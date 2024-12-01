<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesOfAttraction extends Model
{
    use HasFactory;

    protected $primaryKey = 'types_of_attraction_id';

    protected $fillable = [
        'types_of_attraction_name',
    ];
}
