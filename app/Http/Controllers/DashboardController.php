<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('dashboard');
    }
}
