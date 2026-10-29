# Analisis & Arsitektur Proyek: LKartu-Review

Dokumen ini berisi rangkuman analisis teknis, konsep produk, arsitektur sistem, panduan setup, dan roadmap pengembangan untuk proyek **LKartu-Review**.

---

## 1. Ringkasan & Konsep Produk

**LKartu-Review** adalah platform berbasis web untuk mengelola kartu review digital pintar berbasis **NFC dan QR Code fisik** yang ditujukan bagi pelaku usaha (UMKM seperti kafe, restoran, klinik, barbershop, salon, dsb.).

### Prinsip Utama:
- **Decoupled URL:** Kartu fisik tidak menyimpan link tujuan secara langsung, melainkan URL permanen:
  ```
  https://domain.com/r/{UNIQUE_CODE}
  ```
- **Sekali Konfigurasi Fisik:** Vendor cetak atau tim operasional cukup memprogram chip NFC atau mencetak QR code dengan URL `/r/{code}` sekali saja. Target URL Google Review/Maps dikelola secara dinamis di server.
- **Siklus Hidup Kartu (Lifecycle):**
  1. **Sebelum Aktivasi (`unactivated`):** Kartu yang baru dicetak belum memiliki tautan bisnis. Ketika discan, sistem mendeteksi status belum aktif dan mengarahkan ke form aktivasi (`/aktivasi/{code}`).
  2. **Proses Aktivasi:** Pemilik usaha memasukkan nama bisnis dan link Google Maps/Review.
  3. **Setelah Aktivasi (`active`):** Setiap kali pelanggan men-tap atau memindai kartu, sistem langsung melakukan HTTP 302 Redirect ke halaman Google Review bisnis secara instan.

---

## 2. Arsitektur & Tech Stack

| Komponen | Teknologi | Keterangan |
|---|---|---|
| **Backend Framework** | Laravel 11 / 12 | Routing, MVC, Eloquent ORM, Database Migrations |
| **Bahasa Pemrograman** | PHP 8.3+ | Fitur tiping ketat & performa optimal |
| **Database** | SQLite (dev) / MySQL (prod) | Relasi tabel `cards`, `users`, `cache`, `jobs` |
| **Frontend Templating** | Blade Templates | Rendering server-side cepat tanpa SPA complexity |
| **Styling & Desain** | Vanilla CSS | Mengusung tema *boarding pass / tiket fisik* & San Francisco system font |
| **QR Code Service** | `api.qrserver.com` | Generator QR Code dinamis di halaman konfirmasi aktivasi |

---

## 3. Panduan Setup & Menjalankan Proyek

### Prasyarat (Prerequisites)
Pastikan sistem sudah terpasang:
- **PHP >= 8.3** (dengan ekstensi `pdo_sqlite` / `pdo_mysql`, `mbstring`, `openssl`, `curl`)
- **Composer** (PHP dependency manager)
- **Node.js (v18+) & NPM**

Periksa instalasi:
```bash
php -v
composer -V
node -v
npm -v
```

---

### Cara Cepat (One-Line Setup)
Proyek ini sudah dilengkapi skrip otomatis di `composer.json`:

```bash
# 1. Menjalankan seluruh proses setup otomatis (install dep, copy .env, key:generate, migrate, build assets)
composer run setup

# 2. Menjalankan server aplikasi & asset watcher secara bersamaan
composer run dev
```

---

### Langkah Manual (Step-by-Step)

Jika ingin menjalankan setup secara bertahap manual:

1. **Clone & Masuk ke Direktori Proyek:**
   ```bash
   cd LKartu-Review
   ```

2. **Install Dependensi PHP:**
   ```bash
   composer install
   ```

3. **Salin File Environment:**
   - Di Windows PowerShell:
     ```powershell
     copy .env.example .env
     ```
   - Di Linux/macOS:
     ```bash
     cp .env.example .env
     ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi Database:**
   - **Default (SQLite):** Pastikan file database ada di `database/database.sqlite`. Jika belum ada, buat file kosong tersebut:
     - PowerShell: `New-Item -ItemType File -Path database\database.sqlite -Force`
     - Bash: `touch database/database.sqlite`
   - Pastikan di file `.env`:
     ```env
     DB_CONNECTION=sqlite
     ```

6. **Jalankan Migrasi Database:**
   ```bash
   php artisan migrate
   ```

7. **Install & Build Frontend Assets:**
   ```bash
   npm install
   npm run build
   ```
   *(Untuk proses development aktif dengan hot-reload, gunakan: `npm run dev`)*

8. **Jalankan Local Development Server:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses di browser pada: **`http://localhost:8000`**

---

### Cara Menguji Coba Alur Kartu (Testing Workflow)

1. Buka browser ke **`http://localhost:8000`**.
2. Pada landing page, klik tombol **"Buat Kartu Demo"** (atau akses `POST /demo/buat`).
3. Sistem akan membuat sebuah kartu baru dengan kode acak 8 karakter dan membuka halaman aktivasi:
   ```
   http://localhost:8000/aktivasi/{UNIQUE_CODE}
   ```
4. Masukkan **Nama Usaha** dan **Link Google Maps / Review** (bisa coba klik tombol bantuan *Google Maps* di samping input untuk mengambil link).
5. Klik **"Aktivasi Kartu Sekarang"**.
6. Anda akan diarahkan ke halaman konfirmasi selesai (`/aktivasi/{code}/selesai`) yang menampilkan QR code bisnis.
7. Sekarang, uji coba fungsi redirect utama kartu dengan membuka link:
   ```
   http://localhost:8000/r/{UNIQUE_CODE}
   ```
   Sistem akan secara instan me-redirect browser Anda langsung ke halaman Google Review bisnis yang sudah didaftarkan!

---

## 4. Skema Basis Data (Tabel `cards`)

Migrasi database didefinisikan pada `database/migrations/2026_09_07_000000_create_cards_table.php`:

| Kolom | Tipe | Index / Nullable | Keterangan |
|---|---|---|---|
| `id` | `id()` | Primary Key | ID unik kartu di database |
| `unique_code` | `string(12)` | Unique | Kode 8 karakter acak (huruf besar + angka) |
| `status` | `enum('unactivated', 'active')` | Indexed | Default: `unactivated` |
| `user_id` | `foreignId` | Nullable | Relasi ke pemilik kartu (`users.id`) |
| `target_url` | `string(500)` | Nullable | URL review Google Maps |
| `business_name` | `string(255)` | Nullable | Nama tempat usaha |
| `activated_at` | `timestamp` | Nullable | Waktu kartu diaktivasi |
| `timestamps` | `timestamp` | - | `created_at` & `updated_at` |

---

## 5. Alur Kerja (Flow Lifecycle)

Alur visual dari interaksi pengguna dan pelanggan:

```text
Pelanggan / Pemilik Tap NFC atau Scan QR
                  │
                  ▼
            GET /r/{code}
                  │
         ┌────────┴────────┐
         ▼                 ▼
   [Belum Aktif]      [Sudah Aktif]
         │                 │
         ▼                 └─► HTTP 302 Redirect ke target_url (Google Review)
GET /aktivasi/{code}
(Form Aktivasi Usaha)
         │
    Submit Form
         ▼
POST /aktivasi/{code}
(Validasi & Simpan Data)
         │
         ▼
GET /aktivasi/{code}/selesai
(Konfirmasi Berhasil & Tampilan QR Usaha)
```

---

## 6. Daftar Route & Endpoint

| Method | Endpoint | Nama Route | Controller Method | Fungsi |
|---|---|---|---|---|
| `GET` | `/` | - | Closure (`view('welcome')`) | Landing page pemasaran & fitur buat kartu demo |
| `GET` | `/r/{code}` | `cards.redirect` | `CardController@redirect` | Gerbang utama scan kartu fisik (redirect engine) |
| `GET` | `/aktivasi/{code}` | `cards.activate.form` | `CardController@activateForm` | Tampilan form aktivasi kartu |
| `POST` | `/aktivasi/{code}` | `cards.activate.submit` | `CardController@activate` | Memproses data aktivasi dan mengaktifkan kartu |
| `GET` | `/aktivasi/{code}/selesai` | `cards.activated` | `CardController@activated` | Halaman konfirmasi setelah aktivasi selesai |
| `POST` | `/demo/buat` | `cards.demo.create` | `CardController@createDemo` | Prototype untuk generate kartu demo untuk testing |

---

## 7. Status Implementasi Saat Ini

### ✅ Fitur yang Sudah Selesai (MVP):
1. **Core Redirect Engine:** Routing `/r/{code}` mampu memisahkan alur antara kartu baru vs kartu yang sudah aktif dengan cepat.
2. **Form Aktivasi Ramah Pengguna:**
   - Dilengkapi tombol shortcut **Buka Google Maps** untuk mempermudah pengguna menyalin URL review.
   - Validasi nama bisnis dan format URL.
3. **Halaman Konfirmasi Aktivasi:**
   - Menampilkan status sukses aktivasi, nama usaha, ringkasan link.
   - Menampilkan QR Code langsung ke profil bisnis yang bisa diuji coba atau disimpan.
4. **Landing Page:** Tampilan responsif lengkap dengan penjelasan cara kerja produk.
5. **Design System & Dokumentasi:** Memiliki panduan gaya visual di [DESIGN.md](../DESIGN.md) dan riwayat perubahan di [CHANGELOG.md](./CHANGELOG.md).

---

## 8. Keterbatasan & Hal yang Perlu Dikembangkan (Roadmap)

1. **Autentikasi & Kepemilikan (Auth & Ownership):**
   - Saat ini proses aktivasi belum mewajibkan login pengguna (`user_id` masih diisi `Auth::id()` yang bernilai `null`).
   - Perlu mekanisme registrasi/login atau Magic Link/OTP agar pemilik usaha bisa login kembali dan mengelola kartu miliknya.
2. **Fitur Edit Target URL:**
   - Setelah kartu aktif, kartu tidak lagi bisa diakses form aktivasinya (langsung diredirect). Perlu dibuat halaman khusus manajemen/edit link untuk kartu yang sudah aktif dengan autentikasi pemilik.
3. **Admin Dashboard & Generator Batch Kartu:**
   - Belum ada dashboard administrator untuk memproduksi batch kartu baru (misal: generate 500 kode unik sekaligus) dan mengekspor datanya ke CSV/Excel untuk vendor cetak NFC.
4. **Analitik & Tracking Scan:**
   - Belum ada pencatatan metrik, seperti:
     - Jumlah tap/scan (counter).
     - Waktu scan terakhir (`last_scanned_at`).
     - Jenis perangkat / browser pengunjung.
5. **Testing Otomatis (Automated Tests):**
   - Test suite di direktori `tests/Feature` dan `tests/Unit` masih default bawaan Laravel. Perlu ditambahkan unit test untuk model `Card` dan feature test untuk alur redirect, validasi aktivasi, dan proteksi kartu aktif.
