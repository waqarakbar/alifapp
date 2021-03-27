<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sibling extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'applicant_id',
        'name',
        'dob',
        'class',
        'session'
    ];

    public function applicant(){
        return $this->belongsTo(Applicant::class);
    }
}
