<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class thankyouController extends Controller
{
    public function index(){
        return view('thankyou');
    }
}
