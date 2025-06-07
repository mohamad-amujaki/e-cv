<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CvController extends Controller
{
    public function show ()
    {
        $name = "Mohamad Arif Mujaki";
        $email = "mohamad.amujaki@gmail.com";
        $occupation = "Civil Servants of the Ministry of Health";
        $interests = "Tech, Coding, Public Services Innovation";
        $location = "Jakarta, Indonesia";

        return view("cv", compact("name", "email", "occupation", "interests", "location"));
    }
}
