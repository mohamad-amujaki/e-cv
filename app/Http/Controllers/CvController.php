<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function loadData ()
    {
        $jsonFile = "data.json";

        if (!Storage::disk("public")->exists($jsonFile))
        {
            abort(404, "File Json tidak ditemukan");
        }

        $jsonContent = Storage::disk("public")->get($jsonFile);

        $data = json_decode($jsonContent, true);

        return view("cv-load", compact("data"));

    }
}
