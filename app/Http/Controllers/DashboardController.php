<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplyingGrade;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        if(!Auth::check()){
            return redirect(route('login'));
        }else{
            return redirect(route('dashboard'));
        }
    }

    public function summaryDashboard(Request $request){

        $data = [
            'title' => 'Dashboard'
        ];

        $data['class_count'] = ApplyingGrade::count();
        $data['section_count'] = Section::count();
        $data['applicant_count'] = Applicant::count();

        // class wise applicants donut chart
        $sql = "select
                ag.title as classTitle,
                count(ap.id) as applicantCount
                from
                applying_grades as ag
                left join applicants as ap on ag.id = ap.applying_grade_id
                where ag.deleted_at is null
                and ap.deleted_at is null
                group by ag.id";

        $data['class_wise_count'] = DB::select($sql);

        // dd($data);
        $data['colors'] = ['#DC7633', '#C39BD3', '#7FB3D5', '#76D7C4', '#7DCEA0', '#82E0AA', '#F4D03F', '#6E2C00'];

        return view('dashboard', $data);
    }
}
