<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function countryApplicants(){
        return $this->hasMany(Applicant::class);
    }

    public function provinces(){
        return $this->hasMany(Province::class, 'country_id', 'id');
    }
}
