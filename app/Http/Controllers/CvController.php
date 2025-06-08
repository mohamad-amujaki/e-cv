<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    private $jsonFile = "cv_data.json";
    private $cacheKey = "cv_data_from_json";
    private $cacheDuration = 60 * 60;

    private function getCvData()
    {
        // Gunakan Cache::remember() untuk mengambil atau menyimpan data
        return Cache::remember($this->cacheKey, $this->cacheDuration, function () {
            // Logika ini hanya akan dijalankan jika data tidak ada di cache

            // Periksa apakah file JSON ada di disk "public" (storage/app/public)
            if (!Storage::disk("public")->exists($this->jsonFile)) {
                // Jika tidak ada, hentikan eksekusi dengan error 404
                abort(404, "File Json tidak ditemukan");
            }

            // Ambil konten JSON
            $jsonContent = Storage::disk("public")->get($this->jsonFile);

            // Decode JSON menjadi array PHP
            $decodeData = json_decode($jsonContent, true);

            // Periksa apakah decoding berhasil dan hasilnya adalah array
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($decodeData)) {
                // Jika ada error atau bukan array, hentikan dengan error 500
                abort(500, "Gagal mengurai data dari file Json. Format tidak valid");
            }

            // Kembalikan data yang akan di-cache
            return $decodeData;
        });
    }

    public function show()
    {
        $name = "Mohamad Arif Mujaki";
        $email = "mohamad.amujaki@gmail.com";
        $occupation = "Civil Servants of the Ministry of Health";
        $interests = "Tech, Coding, Public Services Innovation";
        $location = "Jakarta, Indonesia";

        return view("cv", compact("name", "email", "occupation", "interests", "location"));
    }

    /**
     * Memuat data CV dari file JSON dan menampilkannya di Blade view.
     * Menggunakan metode getCvData() untuk pengambilan data.
     */
    public function loadData()
    {
        // Panggil metode pembantu untuk mendapatkan data CV
        $data = $this->getCvData();

        // Tampilkan data ke view
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

    /**
     * Mempereview CV sebagai dokumen PDF.
     * Menggunakan metode getCvData() untuk pengambilan data dan merender Blade view ke PDF.
     */
    public function previewCvPdf()
    {
        // Panggil metode pembantu untuk mendapatkan data CV
        $data = $this->getCvData();

        // Muat Blade view Anda (cv-load.blade.php) ke DomPDF
        // Untuk kontrol yang lebih baik pada PDF, Anda bisa membuat view terpisah
        // atau menyesuaikan styling khusus untuk PDF (misalnya, @media print CSS).
        $pdf = Pdf::loadView('cv-load-json', compact('data'));

        return $pdf->stream('CV_Mohamad_Arif_Mujaki.pdf');

        // Kembalikan PDF sebagai respons unduhan
        // 'CV_Mohamad_Arif_Mujaki.pdf' adalah nama file yang akan diunduh
        // return $pdf->download('CV_Mohamad_Arif_Mujaki.pdf');
    }
}
