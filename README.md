## Aplikasi CV Dinamis dengan Laravel
Aplikasi ini adalah contoh proyek Laravel sederhana yang dirancang untuk menampilkan Curriculum Vitae (CV) secara dinamis. Data CV dimuat dari file JSON, dirender menggunakan Blade dan Tailwind CSS, serta memiliki fitur unduh PDF dan pratinjau PDF.

## Tumpukan Teknologi (Tech Stack)
- Backend: PHP, Laravel
- Frontend: Blade Templating Engine, Tailwind CSS
- Database: Tidak menggunakan database (data dari file JSON)

## Fitur Tambahan:
- Caching data CV menggunakan Laravel Cache (file driver).
- Generate PDF dari Blade View menggunakan barryvdh/laravel-dompdf.
- Unit dan Feature Testing menggunakan PHPUnit.

## Pengembangan Lokal
Ikuti langkah-langkah di bawah ini untuk menyiapkan dan menjalankan aplikasi ini di lingkungan pengembangan lokal Anda.

### Prasyarat
1. Pastikan Anda memiliki hal-hal berikut terinstal di mesin Anda:
- PHP (8.1 atau lebih baru direkomendasikan)
- Composer
- Node.js & npm (untuk mengompilasi aset Tailwind CSS)
- Git

2. Langkah-langkah Setup
- Kloning Repositori:
```
git clone https://github.com/mohamad-amujaki/e-cv.git 
cd e-cv
```
  
1. Instal Dependensi Composer:
``` composer install ```

2. Instal Dependensi Node.js & Kompilasi Aset Frontend:
``` npm install ```
``` npm run dev # Untuk pengembangan ```
atau
``` npm run build # Untuk produksi/final ```

3. Konfigurasi File .env:
Salin file .env.example ke .env:
```cp .env.example .env ```

4. Pastikan variabel lingkungan dasar dikonfigurasi, terutama APP_KEY.
Hasilkan Kunci Aplikasi:
``` php artisan key:generate ```

5. Siapkan Data CV:
- Aplikasi ini memuat data CV dari file JSON.
- Buat file bernama data.json di direktori storage/app/public/. 
- Contoh struktur kontennya:
```
{
    "personal": {
        "name": "Nama Anda",
        "title": "Judul Profesional Anda",
        "email": "email@example.com",
        "phone": "+62 81234567890",
        "location": "Kota, Negara",
        "summary": "Ringkasan singkat tentang diri Anda."
    },
    "social_links": [
        {
            "platform": "LinkedIn",
            "url": "https://linkedin.com/in/namaanda",
            "icon_class": "fab fa-linkedin-in"
        }
    ],
    "experience": [],
    "education": [],
    "skills": {},
    "projects": []
}
```

- Anda dapat mengisi data ini sesuai CV Anda.

- Jalankan Server Pengembangan Laravel:
php artisan serve

- Aplikasi akan tersedia di http://127.0.0.1:8000/e-cv.

### Penggunaan
1. Mengakses CV: Buka browser Anda dan navigasikan ke http://127.0.0.1:8000/cv.
2. Mengunduh PDF: Di halaman CV, klik tombol "Download CV (PDF)".
3. Pratinjau PDF: Navigasikan ke http://127.0.0.1:8000/cv/download untuk melihat pratinjau PDF langsung di browser.

### Cara Memperbarui Konten CV
Untuk memperbarui konten CV:
1. Buka file storage/app/public/data.json.
2. Edit konten JSON sesuai dengan informasi CV terbaru Anda.
3. Karena aplikasi menggunakan caching, setelah mengedit file, Anda mungkin perlu membersihkan cache agar perubahan terlihat:
``` php artisan cache:clear ```

Kemudian refresh halaman CV di browser Anda.

## Pengujian
Aplikasi ini dilengkapi dengan feature test dasar untuk memastikan fungsionalitas inti bekerja dengan benar.
Untuk menjalankan semua test:
``` php artisan test ```


Untuk menjalankan test spesifik (misalnya, hanya test halaman CV):
``` php artisan test tests/Feature/CvPageTest.php ```


## Deployment
Untuk instruksi langkah demi langkah mengenai cara menerapkan aplikasi ini ke lingkungan produksi, silakan merujuk ke Panduan Deployment.

Terima kasih telah menggunakan aplikasi ini!
