<p align="center"><div align="center">

  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Blade-F7523F?style=for-the-badge&logo=laravel&logoColor=white" alt="Blade">
  <img src="https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">

  <br><br>

  <h1>🃏 LKartu-Review</h1>

  <p><strong>Sistem Kartu Review Digital dengan Kode Unik & Redirect Google Maps</strong></p>

  <p>
    <img src="https://img.shields.io/badge/Version-1.0.0-blue?style=flat-square">
    <img src="https://img.shields.io/badge/Status-Development-orange?style=flat-square">
    <img src="https://img.shields.io/badge/Laravel-13.17-FF2D20?style=flat-square&logo=laravel">
    <img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php">
  </p>

</div>

---

## 📋 Tentang Project

**LKartu-Review** adalah aplikasi web berbasis **Laravel** untuk mengelola kartu review digital. Setiap kartu memiliki **kode unik 8 karakter** (huruf besar + angka) yang dapat dicetak pada kartu fisik (NFC/QR code). Saat kartu discan, pengguna akan diarahkan ke halaman aktivasi untuk mengisi nama bisnis dan link Google Review. Setelah diaktivasi, kartu akan secara permanen mengarahkan ke link review tersebut.

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 🃏 **Kode Unik Otomatis** | Generate kode acak 8 karakter (huruf besar + angka) per kartu |
| 🔗 **Redirect Permanen** | Kartu yang sudah aktif langsung mengarahkan ke link review |
| 📝 **Form Aktivasi** | Halaman aktivasi untuk mengisi nama bisnis dan URL review |
| ✅ **Status Kartu** | Status `active` / `inactive` dengan timestamp aktivasi |
| 👤 **Ownership** | Kartu dapat dikaitkan dengan user tertentu |
| 🔄 **Reusable** | Kode kartu tetap permanen, hanya target URL yang diatur saat aktivasi |

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Framework** | Laravel 13.17 |
| **Language** | PHP 8.3+ |
| **Templating** | Blade |
| **Build Tool** | Vite |
| **Database** | SQLite / MySQL |

---

## 📂 Struktur File (Sesuai Repository)

```
LKartu-Review/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── CardController.php      # Controller utama kartu
│   │       └── Controller.php          # Base controller
│   └── Models/
│       ├── Card.php                    # Model kartu (unique_code, status, target_url, dll)
│       └── User.php                    # Model user
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/                     # Tabel database
│   └── seeders/
├── public/                             # Entry point & asset
├── resources/
│   ├── css/
│   ├── js/
│   └── views/                          # Blade templates
├── routes/
│   ├── console.php
│   └── web.php                         # Definisi route
├── storage/
├── tests/
├── .editorconfig
├── .env.example
├── .gitattributes
├── .gitignore
├── .npmrc
├── AGENTS.md
├── CLAUDE.md
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── phpunit.xml
├── vite.config.js
└── README.md
```

---

## 🔌 Daftar Route (Sesuai web.php)

| Route | Method | Controller | Fungsi |
|-------|--------|------------|--------|
| `/` | GET | Closure | Halaman welcome |
| `/r/{code}` | GET | `CardController@redirect` | Redirect ke link review (atau halaman aktivasi) |
| `/aktivasi/{code}` | GET | `CardController@activateForm` | Tampilkan form aktivasi kartu |
| `/aktivasi/{code}` | POST | `CardController@activate` | Proses aktivasi kartu |
| `/aktivasi/{code}/selesai` | GET | `CardController@activated` | Halaman konfirmasi sukses aktivasi |

---

## 🗄️ Skema Model Card (Sesuai Card.php)

| Field | Tipe | Keterangan |
|-------|------|------------|
| `unique_code` | string | Kode unik 8 karakter (huruf besar + angka) |
| `status` | string | `active` atau `inactive` |
| `user_id` | integer | ID pemilik kartu (nullable) |
| `target_url` | string | URL review tujuan (Google Review, dll) |
| `business_name` | string | Nama bisnis |
| `activated_at` | datetime | Waktu aktivasi kartu |

---

## ⚙️ Alur Kerja Sistem

```
┌─────────────┐     ┌─────────────────┐     ┌─────────────┐
│  📱 Scan    │────▶│ /r/{code}       │────▶│ 📋 Cek      │
│  Kartu      │     │                 │     │   Status    │
└─────────────┘     └─────────────────┘     └──────┬──────┘
                                                   │
                              ┌────────────────────┼────────────────────┐
                              │                    │                    │
                              ▼                    ▼                    ▼
                         ┌─────────┐        ┌─────────────┐      ┌──────────┐
                         │ ❌      │        │ 📝 Form      │      │ ✅       │
                         │ 404     │        │  Aktivasi    │      │ Redirect │
                         │         │        │              │      │ Review   │
                         └─────────┘        └──────┬──────┘      └──────────┘
                                                    │
                                                    ▼
                                             ┌─────────────┐
                                             │ ✅ Aktivasi  │
                                             │   Sukses     │
                                             │   (Permanen) │
                                             └─────────────┘
```

---

## 📝 Cara Pakai

### 1. Generate Kartu Baru
```php
// Di tinker atau seeder
$card = Card::create([
    'unique_code' => Card::generateUniqueCode(),
    'status' => 'inactive',
]);
```

### 2. Cetak Kode ke Kartu Fisik
Cetak kode unik (misal: `1KD0RQW4`) pada kartu NFC atau QR code.

### 3. Scan Kartu
Saat discan, kartu mengarah ke `https://domain.com/r/1KD0RQW4`.

### 4. Aktivasi
Pengguna mengisi:
- **Nama Bisnis**: Contoh "Warung Makan Sederhana"
- **URL Review**: Link Google Review bisnis

Setelah aktivasi, kartu permanen mengarah ke link review tersebut.

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan:
1. Fork repository ini
2. Buat branch fitur (`git checkout -b fitur-anda`)
3. Commit perubahan (`git commit -m 'Tambah fitur X'`)
4. Push ke branch (`git push origin fitur-anda`)
5. Buat Pull Request

---

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

---

<div align="center">
  <sub>Dibuat oleh <a href="https://github.com/Faraysz">@Faraysz</a></sub>
</div>
