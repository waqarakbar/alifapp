<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplyingGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ApplyingGradesController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Grades / Classes'
        ];

        $data['grades'] = ApplyingGrade::with('sections')->get();

        return view('applying_grades.index', $data);
    }


    public function gradeForm(ApplyingGrade $grade, $id = null){

        if(!is_null($id)){
            $grade = ApplyingGrade::find(Crypt::decrypt($id));
        }


        $data = [
            'title' => 'New Grade / Class',
            'grade' => $grade
        ];

        return view('applying_grades.form', $data);

    }


    public function save(Request $request){
        $inputs = $request->all();
        // dd($inputs);

        try {

            if($request->has('id')){
                $grade = ApplyingGrade::find(Crypt::decrypt($request->get('id')));
            }else{
                $grade = new ApplyingGrade();
            }

            $grade->fill($inputs);
            $grade->save();


            Session::flash('success', 'Grade saved successfully');
            return redirect(route('applying-grades.all-grades'));

        }catch(Exception $e){
            DB::rollBack();
            Session::flash('error', 'Something went wrong, please try again');
            return redirect(route('applying-grades.all-grades'));
        }
    }


    public function deleteGrade(Request $request, $id){

        $id = Crypt::decrypt($id);
        $grade = ApplyingGrade::with(['applicants', 'sections'])->find($id);

        if($grade->applicants->count() > 0){
            Session::flash('error', 'There are students enrolled in this grade, you can not deleted it.');
            return redirect(route('applying-grades.all-grades'));
        }

        // dd($grade);

        $grade->delete();

        Session::flash('success', 'Grade deleted successfully');
        return redirect(route('applying-grades.all-grades'));

    }
}
