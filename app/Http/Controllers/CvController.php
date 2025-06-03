<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CvController extends Controller
{
    public function show ()
    {
        $name = "Mohamad Arif Mujaki";
        $occupation = "Civil Servants of the Ministry of Health";
        $interests = "Tech, Coding, Public Services Innovation";

        return view("cv", compact("name", "occupation", "interests"));
    }
}
