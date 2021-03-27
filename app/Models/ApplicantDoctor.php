<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantDoctor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'applicant_id',
        'major_surgeries',
        'medications',
        'doctor_name',
        'address',
        'phone_number'
    ];

    public function applicant(){
        return $this->belongsTo(Applicant::class, 'applicant_id', 'id');
    }
}
