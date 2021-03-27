<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'applying_grade_id', 'title'
    ];

    public function applyingGrade(){
        return $this->belongsTo(ApplyingGrade::class);
    }

    public function applicants(){
        return $this->hasMany(Applicant::class, 'section_id', 'id');
    }
}
