<?php

namespace Tests\Feature;

use GuzzleHttp\Psr7\Response;
use Tests\TestCase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CvDownloadTest extends TestCase
{
    /**
     * Setup the test environment.
     * Metode ini akan dijalankan sebelum setiap test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Pastikan file data.json ada untuk test
        // Jika file sudah ada di public/data.json secara persisten,
        // Anda mungkin tidak perlu membuat ulang di sini, tetapi untuk memastikan
        // konsistensi test, membuatnya ulang adalah praktik yang baik.
        $dummyJsonContent = json_encode([
            'personal' => [
                'name' => 'John Doe',
                'title' => 'Software Engineer',
                'email' => 'john.doe@example.com',
                'phone' => '123-456-7890',
                'location' => 'Jakarta, Indonesia',
                'summary' => 'A dummy summary for testing purposes.'
            ],
            'experience' => [],
            'education' => [],
            'skills' => [],
            'projects' => [],
            'social_links' => []
        ]);
        Storage::disk('public')->put('data.json', $dummyJsonContent);

        // Bersihkan cache untuk memastikan setiap test membaca data yang segar
        Cache::forget('cv_data_from_json');
    }
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/cv/download');

        $response->assertStatus(200);
    }

    /**
     * Clean up the testing environment once the test finishes.
     * Metode ini akan dijalankan setelah setiap test.
     */
    protected function tearDown(): void
    {
        // Hapus file dummy setelah test selesai
        Storage::disk('public')->delete('data.json');
        parent::tearDown();
    }

}
