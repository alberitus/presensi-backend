# 🖥️ Presensi Backend

Presensi Backend adalah **RESTful API** yang dibangun menggunakan **Laravel 12** untuk mendukung aplikasi [📲 Presensi App (Flutter)](https://github.com/alberitus/Presensi-App).  
API ini mengelola proses autentikasi, absensi karyawan, pengajuan request, dan manajemen data user.

---

## 🚀 Fitur Utama
- 🔑 **Authentication** (Login berbasis NIK & Password)
- 👨‍💼 **Manajemen User/Karyawan**
- 📝 **Manajemen Request** (izin, lembur, cuti)
- 📊 **Rekap Kehadiran** (absensi harian/bulanan)
- 🔗 **RESTful API** untuk integrasi dengan aplikasi Flutter
- 🗂️ **Role & Permission** dasar (admin, staff, dll)

---

## 🛠️ Teknologi yang Digunakan
- **Framework:** Laravel **10.x**
- **Bahasa Pemrograman:** PHP **8.2+**
- **Database:** **MySQL** / MariaDB
- **API:** RESTful API (JSON Response)
- **Autentikasi:** Laravel Sanctum / JWT (sesuai implementasi)
- **Version Control:** Git & GitHub
- **Environment:** .env untuk konfigurasi koneksi DB & API key

---

1. Clone repository:
   ```bash
   git clone https://github.com/alberitus/presensi-backend.git
   cd presensi-backend
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   php artisan serve
