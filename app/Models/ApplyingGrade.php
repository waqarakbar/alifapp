<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplyingGrade extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title'
    ];

    public function applicants(){
        return $this->hasMany(Applicant::class, 'applying_grade_id', 'id');
    }
}
