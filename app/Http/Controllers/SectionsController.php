<?php

namespace App\Http\Controllers;

use App\Models\ApplyingGrade;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SectionsController extends Controller
{

    public function index(){
        $data = [
            'title' => 'Sections'
        ];

        $data['sections'] = Section::with(['applyingGrade', 'applicants'])->get();

        return view('sections.index', $data);
    }


    public function sectionForm(Section $section, $id = null){

        if(!is_null($id)){
            $section = Section::find(Crypt::decrypt($id));
        }


        $data = [
            'title' => 'New Section',
            'section' => $section,
            'grades' => ApplyingGrade::pluck('title', 'id')
        ];

        return view('sections.form', $data);

    }


    public function save(Request $request){
        $inputs = $request->all();
        // dd($inputs);

        try {

            if($request->has('id')){
                $section = Section::find(Crypt::decrypt($request->get('id')));
            }else{
                $section = new Section();
            }

            $section->fill($inputs);
            $section->save();


            Session::flash('success', 'Section saved successfully');
            return redirect(route('sections.all-sections'));

        }catch(Exception $e){
            DB::rollBack();
            Session::flash('error', 'Something went wrong, please try again');
            return redirect(route('sections.all-sections'));
        }
    }


    public function deleteSection(Request $request, $id){

        $id = Crypt::decrypt($id);
        $section = Section::with(['applicants'])->find($id);

        if($section->applicants->count() > 0){
            Session::flash('error', 'There are students enrolled in this section, you can not deleted it.');
            return redirect(route('sections.all-sections'));
        }

        // dd($grade);

        $section->delete();

        Session::flash('success', 'Section deleted successfully');
        return redirect(route('sections.all-sections'));

    }



    public function sectionsByGradeId(Request $request){
        $grade_id = $request->get('grade_id');

        return Section::where('applying_grade_id', $grade_id)->pluck('title', 'id');
    }
}
