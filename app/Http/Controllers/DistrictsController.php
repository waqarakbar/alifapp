<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    public function districtsByProvinceId(Request $request){
        return District::where('province_id', $request->get('province_id'))->pluck('title', 'id');
    }
}
