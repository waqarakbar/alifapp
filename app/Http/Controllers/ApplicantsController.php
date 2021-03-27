<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use App\Models\Applicant;
use App\Models\ApplyingGrade;
use App\Models\Disease;
use App\Models\District;
use App\Models\Province;
use App\Models\Sibling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'All Applicants'
        ];

        $applicants = Applicant::orderBy('id', 'desc')->get();
        $data['applicants'] = $applicants;

        return view('applicants.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applicantForm(Applicant $applicant, $id=null)
    {

        if(!is_null($id)){
            $applicant = Applicant::find(Crypt::decrypt($id));
        }

        $data = [
            'title' => 'New Applicant',
            'applicant' => $applicant,
            'applying_grades' => ApplyingGrade::pluck('title', 'id')->toArray(),
            'provinces' => Province::pluck('title', 'id')->toArray(),
            'districts' => District::pluck('title', 'id')->toArray()
        ];

        return view('applicants.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $inputs = $request->all();
        // dd($inputs);

        try {

            if($request->has('id')){
                $applicant = Applicant::find(Crypt::decrypt($request->get('id')));
            }else{
                $applicant = new Applicant();
            }

            $applicant->fill($inputs);
            $applicant->save();

            Session::flash('success', 'Applicant saved successfully');
            return redirect(route('applicant.list'));

        }catch(Exception $e){
            DB::rollBack();
            Session::flash('error', 'Something went wrong, please try again');
            return redirect(route('applicant.list'));
        }
    }


    public function applicantProfile($id){

        $data = [
            'title' => 'Applicant Profile',
        ];


        $applicant = Applicant::with([
            'academics' => function($q){
                $q->orderBy('from_date', 'desc');
            },
            'siblings' => function($q){
                $q->orderBy('dob', 'desc');
            },
            'applyingGrade',
            'district',
            'country',
            'fatherDistrict',
            'fatherCountry',
            'motherDistrict',
            'motherCountry',
            'emeDistrict',
            'emeCountry',
            'doctors',
            'applicantDiseases',
        ])->find(Crypt::decrypt($id));
        $data['applicant'] = $applicant;

        // Diseases
        $data['diseases'] = Disease::pluck('title', 'id');

        return view('applicants.applicant_profile', $data);

    }



    public function saveHealthInformation(Request $request){

        $applicant_id = Crypt::decrypt($request->get('applicant_id'));

        $applicant = Applicant::find($applicant_id);

        try{
            // lets sync the diseases
            $applicant->applicantDiseases()->sync($request->get('applicant_diseases'));

            $doctorInformationInputs = [
                'applicant_id' => $applicant_id,
                'major_surgeries' => $request->get('major_surgeries'),
                'medications' => $request->get('medications'),
                'doctor_name' => $request->get('doctor_name'),
                'address' => $request->get('address'),
                'phone_number' => $request->get('phone_number'),
            ];

            $applicant->doctors()->updateOrCreate(['applicant_id' => $applicant_id], $doctorInformationInputs);

            Session::flash('success', 'Health information saved successfully');
            return redirect(route('applicant.applicant-profile', [Crypt::encrypt($applicant_id)]));

        }catch (Exception $e){
            Session::flash('error', 'Something went wrong, please try again');
            return redirect(route('applicant.applicant-profile', [Crypt::encrypt($applicant_id)]));
        }

    }


    public function saveSibling(Request $request){
        $applicant_id = Crypt::decrypt($request->get('applicant_id'));

        try {
            $applicant = Applicant::find($applicant_id);

            $newSiblingFields = [
                'name' => $request->get('name'),
                'dob' => $request->get('dob'),
                'class' => $request->get('class'),
                'session' => $request->get('session'),
            ];

            $applicant->siblings()->create($newSiblingFields);
            Session::flash('success', 'Sibling saved successfully');
            return redirect(route('applicant.applicant-profile', [Crypt::encrypt($applicant_id)]));

        }catch (Exception $e){
            Session::flash('error', 'Something went wrong, please try again');
            return redirect(route('applicant.applicant-profile', [Crypt::encrypt($applicant_id)]));
        }
    }


    public function saveAcademic(Request $request){
        $applicant_id = Crypt::decrypt($request->get('applicant_id'));

        try {
            $applicant = Applicant::find($applicant_id);

            $newAcademicFields = [
                'school' => $request->get('school'),
                'from_date' => $request->get('from_date'),
                'to_date' => $request->get('to_date'),
                'address' => $request->get('address'),
            ];

            $applicant->academics()->create($newAcademicFields);
            Session::flash('success', 'Academic saved successfully');
            return redirect(route('applicant.applicant-profile', [Crypt::encrypt($applicant_id)]));

        }catch (Exception $e){
            Session::flash('error', 'Something went wrong, please try again');
            return redirect(route('applicant.applicant-profile', [Crypt::encrypt($applicant_id)]));
        }
    }


    public function deleteAcademic($id){

        $id = Crypt::decrypt($id);

        try {
            $academic = Academic::find($id);
            $academic->delete();
            Session::flash('success', 'Academic deleted successfully');
            return redirect(route('applicant.applicant-profile', [Crypt::encrypt($academic->applicant_id)]));
        }catch (Exception $e){
            Session::flash('error', 'Something went wrong, please try again');
            return redirect(route('applicant.applicant-profile', [Crypt::encrypt($academic->applicant_id)]));
        }


    }


    public function deleteSibling($id){

        $id = Crypt::decrypt($id);

        try {
            $sib = Sibling::find($id);
            $sib->delete();
            Session::flash('success', 'Sibling deleted successfully');
            return redirect(route('applicant.applicant-profile', [Crypt::encrypt($sib->applicant_id)]));
        }catch (Exception $e){
            Session::flash('error', 'Something went wrong, please try again');
            return redirect(route('applicant.applicant-profile', [Crypt::encrypt($sib->applicant_id)]));
        }


    }
}