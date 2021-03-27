<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'province_id'
    ];

    public function districtApplicants(){
        return $this->hasMany(Applicant::class);
    }

    public function province(){
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
