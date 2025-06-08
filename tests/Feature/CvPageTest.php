<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CvPageTest extends TestCase
{
    /**
     * Setup the test environment.
     * Metode ini akan dijalankan sebelum setiap test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Pastikan file data.json ada untuk test
        $dummyJsonContent = json_encode([
            'personal' => [
                'name' => 'John Doe',
                'title' => 'Software Engineer',
                'email' => 'john.doe@example.com',
                'phone' => '123-456-7890',
                'location' => 'Jakarta, Indonesia',
                'summary' => 'A dummy summary for testing purposes.'
            ],
            'experience' => [
                [
                    'title' => 'Senior Developer',
                    'company' => 'Test Company',
                    'location' => 'Test City',
                    'start_date' => '2020-01',
                    'end_date' => 'Present',
                    'responsibilities' => ['Developed features', 'Managed team']
                ]
            ],
            'education' => [
                [
                    'degree' => 'B.Sc. Computer Science',
                    'institution' => 'Test University'
                ]
            ],
            'skills' => [
                'programming_languages' => ['PHP', 'JavaScript'],
                'frameworks' => ['Laravel', 'Vue.js']
            ],
            'projects' => [
                [
                    'name' => 'Project Alpha',
                    'description' => 'A test project.'
                ]
            ],
            'social_links' => []
        ]);
        Storage::disk('public')->put('data.json', $dummyJsonContent);

        // Bersihkan cache untuk memastikan setiap test membaca data yang segar
        Cache::forget('cv_data_from_json');
    }

    /**
     * Clean up the testing environment once the test finishes.
     * Metode ini akan dijalankan setelah setiap test.
     */
    // protected function tearDown(): void
    // {
    //     // Hapus file dummy setelah test selesai
    //     Storage::disk('public')->delete('data.json');
    //     parent::tearDown();
    // }

    /**
     * Test untuk memastikan halaman CV utama memuat dengan benar.
     *
     * @return void
     */
    public function test_main_cv_page_loads_correctly()
    {
        // Mensimulasikan permintaan GET ke route utama CV
        $response = $this->get(route('/cv-load-json')); // Menggunakan nama route Anda

        // Memverifikasi bahwa respons adalah 200 OK
        $response->assertStatus(200);

        // Memverifikasi bahwa beberapa teks kunci dari CV terlihat di respons
        // Gunakan nama dummy dari setUp()
        $response->assertSee('John Doe');
        $response->assertSee('Software Engineer');
        $response->assertSee('Summary'); // Contoh heading bagian
        $response->assertSee('Experience'); // Contoh heading bagian
        $response->assertSee('Skills'); // Contoh heading bagian
    }

    /**
     * Test untuk memastikan halaman CV utama mengembalikan 404 jika file JSON tidak ditemukan.
     *
     * @return void
     */
    public function test_main_cv_page_returns_404_if_json_file_missing()
    {
        // Hapus file data.json agar test ini bisa mensimulasikan kasus file hilang
        Storage::disk('public')->delete('data.json');
        // Bersihkan cache agar tidak ada data cache lama yang mengganggu test ini
        Cache::forget('cv_data_from_json');

        // Mensimulasikan permintaan GET ke route utama CV
        $response = $this->get(route('cv.loadDataJson'));

        // Memverifikasi bahwa respons adalah 404 Not Found
        $response->assertStatus(404);
        // Memverifikasi bahwa pesan error "File JSON tidak ditemukan" ada di respons
        $response->assertSee('File JSON tidak ditemukan.');
    }
}
