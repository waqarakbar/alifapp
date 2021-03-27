<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disease extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title'
    ];

    public function applicantDiseases(){
        return $this->belongsToMany(Applicant::class, 'applicant_disease', 'disease_id', 'applicant_id');
    }
}
