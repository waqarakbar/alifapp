<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'form_number',
        'applying_grade_id',
        'need_transportation',
        'how_hear_about_us',
        'source_name',
        'session',
        'name',
        'gender',
        'dob',
        'dob_words',
        'address',
        'pobox',
        'village',
        'tehsil',
        'district_id',
        'province_id',
        'country_id',
        'home_phone_number',
        'mobile_number',
        'email_address',
        'father_name',
        'father_cnic',
        'father_cast',
        'father_tribe',
        'father_occupation',
        'father_designation',
        'father_department',
        'father_pobox',
        'father_village',
        'father_tehsil',
        'father_district_id',
        'father_province_id',
        'father_country_id',
        'father_work_phone',
        'father_cell_phone',
        'father_email',
        'mother_name',
        'mother_cnic',
        'mother_cast',
        'mother_tribe',
        'mother_occupation',
        'mother_designation',
        'mother_department',
        'mother_pobox',
        'mother_village',
        'mother_tehsil',
        'mother_district_id',
        'mother_province_id',
        'mother_country_id',
        'mother_work_phone',
        'mother_cell_phone',
        'mother_email',
        'eme_name',
        'eme_cnic',
        'eme_cast',
        'eme_tribe',
        'eme_occupation',
        'eme_designation',
        'eme_department',
        'eme_pobox',
        'eme_village',
        'eme_tehsil',
        'eme_district_id',
        'eme_province_id',
        'eme_country_id',
        'eme_work_phone',
        'eme_cell_phone',
        'eme_email',
        'photo'
    ];

    public function academics(){
        return $this->hasMany(Academic::class);
    }

    public function siblings(){
        return $this->hasMany(Sibling::class);
    }

    public function applyingGrade(){
        return $this->belongsTo(ApplyingGrade::class);
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function fatherDistrict(){
        return $this->belongsTo(District::class, 'father_district_id', 'id');
    }

    public function fatherCountry(){
        return $this->belongsTo(Country::class, 'father_country_id', 'id');
    }


    public function motherDistrict(){
        return $this->belongsTo(District::class, 'mother_district_id', 'id');
    }

    public function motherCountry(){
        return $this->belongsTo(Country::class, 'mother_country_id', 'id');
    }


    public function emeDistrict(){
        return $this->belongsTo(District::class, 'eme_district_id', 'id');
    }

    public function emeCountry(){
        return $this->belongsTo(Country::class, 'eme_country_id', 'id');
    }

    public function doctors(){
        return $this->hasMany(ApplicantDoctor::class, 'applicant_id', 'id');
    }


    public function applicantDiseases(){
        return $this->belongsToMany(Disease::class, 'applicant_disease', 'applicant_id', 'disease_id');
    }


}
