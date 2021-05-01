<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Academic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'applicant_id',
        'school',
        'from_date',
        'to_date',
        'address',
        'slc_received'
    ];

    public function applicant(){
        return $this->belongsTo(Applicant::class);
    }
}
