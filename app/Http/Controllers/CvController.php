<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{

    public function show()
    {
        $name = "Mohamad Arif Mujaki";
        $email = "mohamad.amujaki@gmail.com";
        $occupation = "Civil Servants of the Ministry of Health";
        $interests = "Tech, Coding, Public Services Innovation";
        $location = "Jakarta, Indonesia";

        return view("cv", compact("name", "email", "occupation", "interests", "location"));
    }

    public function loadData()
    {
        $jsonFile = "cv_data.json";
        $cacheKey = "cv_data_from_json"; // Kunci unik untuk data cache ini
        $cacheDuration = 60 * 60;

        // Gunakan Cache::remember()
        $data = Cache::remember($cacheKey, $cacheDuration, function () use ($jsonFile) {
            // Logika ini hanya akan dijalankan jika data tidak ada di cache

            // Periksa apakah file JSON ada di disk "public" (storage/app/public)
            if (!Storage::disk("public")->exists($jsonFile)) {
                abort(404, "File JSON tidak ditemukan.");
            }

            // Ambil konten JSON
            $jsonContent = Storage::disk("public")->get($jsonFile);

            // Decode JSON
            $decodedData = json_decode($jsonContent, true);

            // Periksa apakah decoding berhasil dan hasilnya adalah array
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($decodedData)) {
                // Log error atau tangani sesuai kebutuhan Anda
                abort(500, "Gagal mengurai data dari file JSON.");
            }

            return $decodedData; // Kembalikan data yang akan di-cache
        });

        return view("cv-load", compact("data"));
    }

    public function loadDataJson()
    {
        $jsonFile = "cv_data.json";

        if (!Storage::disk("public")->exists($jsonFile)) {
            abort(404, "File JSON tidak ditemukan.");
        }

        $jsonContent = Storage::disk("public")->get($jsonFile);

            // Decode JSON
        $data = json_decode($jsonContent, true);

        return view("cv-load-json", compact("data"));
    }

    public function previewCvPdf()
    {
        $jsonFile = "cv_data.json";

        if (!Storage::disk("public")->exists($jsonFile)) {
            abort(404, "File JSON tidak ditemukan.");
        }

        $jsonContent = Storage::disk("public")->get($jsonFile);
        // Decode JSON
        $data = json_decode($jsonContent, true);

        // Muat view Blade Anda dengan data
        $pdf = Pdf::loadView('cv-load-json', compact('data'));

        return $pdf->stream('CV_Mohamad_Arif_Mujaki.pdf');
    }
}
