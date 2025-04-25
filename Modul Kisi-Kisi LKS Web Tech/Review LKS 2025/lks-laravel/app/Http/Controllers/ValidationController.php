<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function validation(Request $request){
        $request->validate([
            'work_experience' => 'required',
            'job_category_id' =>'required',
            'job_position' => 'required',
            'reason_accepted' => 'required'
        ]);
    }
}
