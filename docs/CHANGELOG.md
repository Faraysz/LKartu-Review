# Changelog

Catatan semua perubahan yang dilakukan pada proyek ini, diurutkan dari yang terbaru.

---

## 2026-09-09 — Tambah tombol "Kembali ke beranda" di halaman konfirmasi

### File yang diubah

#### `resources/views/cards/activated.blade.php`
- Tambah tombol **"Kembali ke beranda"** di bawah tombol "Buka link Google Review"
- Style: outlined/secondary (border `--line`, teks `--muted`, hover jadi lebih gelap)
- Icon arrow kiri (chevron-left), link ke `/` (homepage)
- Tambah CSS: `.btn-home`, `.btn-home:hover`, `.btn-home svg`

---

## 2026-09-09 — Fix: QR code sekarang mengarah ke link usaha (bukan URL Laravel)

### File yang diubah

#### `resources/views/cards/activated.blade.php`
- **Bug fix**: QR code sebelumnya mengarah ke `route('cards.redirect')` (URL Laravel seperti `http://localhost:8000/r/CODE`) yang tidak bisa diakses dari HP saat develop lokal
- **Fix**: QR code sekarang mengarah langsung ke `$card->target_url` (link Google Maps/Review usaha)
- Sekarang kalau QR di-scan, langsung buka halaman usaha — tidak perlu server Laravel jalan

---

## 2026-09-09 — Tombol Google Maps di form aktivasi

### File yang diubah

#### `resources/views/cards/activate.blade.php`
- Input "Link Google Review" sekarang punya **tombol Maps** di sampingnya
  - Tombol navy gelap (`--ink`) dengan icon map pin
  - Klik → buka Google Maps di tab baru (`https://www.google.com/maps`)
  - User cari usaha mereka di Maps → tekan Bagikan → salin link → paste di input
- Tambah helper text di bawah input: "Klik Maps → cari usaha kamu → tekan Bagikan → salin link → paste di sini."
- Placeholder input diubah: "https://g.page/r/xxxx/review" → "Paste link dari Google Maps"
- Tambah CSS: `.input-group`, `.btn-maps`, `.form-hint`

---

## 2026-09-09 — Tema biru + font San Francisco + QR code di halaman konfirmasi

### Perubahan utama
- Seluruh warna utama diganti dari merah (`#B0402E`) / ink lama (`#1C2B3A`) ke **biru** (`#2563EB`) dan navy baru (`#0F172A`)
- Font diganti dari Fraunces + Inter ke **San Francisco system font** (`-apple-system, BlinkMacSystemFont, 'SF Pro Text'`)
- QR code yang bisa di-scan ditambahkan di halaman konfirmasi aktivasi

### File yang diubah

#### `resources/views/cards/activate.blade.php`
**Redesign total — tema biru + SF font**
- Warna: latar `#F1F5F9`, header navy `#0F172A`, tombol biru `#2563EB`, focus ring biru
- Font: `-apple-system, BlinkMacSystemFont, 'SF Pro Text', system-ui, sans-serif`
- Layout: header gelap (brand + judul + kode kartu) → body form putih
- Hapus Google Fonts import (tidak butuh lagi, pakai system font)
- Border-radius: 12px card, 8px input/button
- Focus state: border biru + box-shadow `rgba(37, 99, 235, 0.1)`

#### `resources/views/cards/activated.blade.php`
**Redesign — tema biru + SF font + QR code**
- Warna: sama seperti activate.blade.php (biru + navy)
- Font: SF system font
- **QR code baru**: pakai `api.qrserver.com` API, generate QR code real yang bisa di-scan
  - QR mengarah ke `/r/{unique_code}` (redirect endpoint)
  - Ukuran 200x200px, ditampilkan 160x160px
  - Section "Scan untuk buka halaman usaha ini" dengan hint cetak/screenshot
- Stamp motif: tetap pakai circle outline + checkmark, rotate -6deg (warna `--success` hijau)
- Ringkasan: usaha, link review (biru), tanggal aktivasi
- Tombol "Buka link Google Review" pakai `--ink` (navy)

#### `resources/views/welcome.blade.php`
**Tema biru + SF font**
- CSS variables diubah:
  - `--ink: #0F172A` (navy baru)
  - `--paper: #F1F5F9` (latar slate terang)
  - `--surface: #FFFFFF` (putih bersih)
  - `--stamp: #2563EB` (biru utama)
  - `--stamp-hover: #1D4ED8`
  - `--success: #16A34A`
  - `--muted: #64748B`
  - `--line: #E2E8F0`
  - `--warning-dot: #F59E0B`
- Hapus Google Fonts import (Fraunces + Inter)
- Semua `font-family: 'Fraunces'` → SF system font
- Semua `font-family: 'Inter'` → SF system font
- Shadow: `rgba(28, 43, 58, 0.14)` → `rgba(15, 23, 42, 0.1)`
- Nav background: `rgba(251, 250, 247, 0.85)` → `rgba(255, 255, 255, 0.9)`
- Hover colors disesuaikan (`#14202c` → `#1E293B`)
- Feature hover: disesuaikan ke `rgba(241, 245, 249, 0.6)`

### Palet warna baru (final)
| Token | Hex | Fungsi |
|---|---|---|
| `--ink` | `#0F172A` | Teks utama, latar header, tombol navigasi |
| `--paper` | `#F1F5F9` | Latar halaman |
| `--surface` | `#FFFFFF` | Latar kartu/panel |
| `--stamp` | `#2563EB` | Aksen utama, tombol aksi, link |
| `--stamp-hover` | `#1D4ED8` | Hover state `--stamp` |
| `--success` | `#16A34A` | Status aktif, konfirmasi |
| `--muted` | `#64748B` | Teks sekunder |
| `--line` | `#E2E8F0` | Border, pembatas |
| `--warning-dot` | `#F59E0B` | Indikator belum aktif |

---

## 2026-09-09 — Prototype: tombol demo + input kode kartu di welcome page

### File yang diubah

#### `app/Http/Controllers/CardController.php`
- Tambah method `createDemo()` — generate kartu baru di database dengan `Card::generateUniqueCode()`, status `unactivated`, lalu redirect ke halaman aktivasi `/aktivasi/{code}`
- Ditandai `[PROTOTYPE]` — nanti dihapus atau dipindah ke admin dashboard setelah auth jadi

#### `routes/web.php`
- Tambah route: `POST /demo/buat` → `CardController@createDemo`, nama route `cards.demo.create`
- Ditandai `[PROTOTYPE]`

#### `resources/views/welcome.blade.php`
- **Ganti section CTA** (`#mulai`) dengan section **"Coba alur aktivasinya"** yang interaktif:
  - Tombol **"Buat kartu demo"** — form POST ke `/demo/buat`, generate kartu baru dan langsung redirect ke halaman aktivasi
  - Divider "atau"
  - **Input kode kartu** — text field + tombol "Buka", redirect ke `/r/{code}` (JavaScript)
  - Validasi: error message kalau kode kosong
  - Support Enter key untuk submit input
- Tambah CSS untuk `.demo*` classes (section, title, desc, actions, form, btn, divider, lookup, input, go, hint, error)
- Section `#mulai` tetap ada (buat anchor nav), tapi sekarang mengarah ke demo section

### Cara prototype bekerja
1. User buka welcome page → scroll ke section "Coba alur aktivasinya"
2. Klik "Buat kartu demo" → sistem buat kartu baru di DB → redirect ke `/aktivasi/{code}` (form aktivasi)
3. Isi nama usaha + link review → submit → redirect ke `/aktivasi/{code}/selesai` (konfirmasi)
4. Kalau mau buka kartu yang sudah ada, ketik kode di input → "Buka" → redirect ke `/r/{code}`

---

## 2026-09-09 — Rombak desain sesuai DESIGN.md + tambah section QR code

### File yang diubah

#### `resources/views/welcome.blade.php`
**Perubahan besar: redesign total agar sesuai DESIGN.md + fitur baru**

CSS / Visual:
- Tambah CSS variable `--stamp-hover: #973324` dan `--warning-dot: #E8B74A` (sesuai DESIGN.md section 2)
- Border-radius semua panel/kartu: `16px` / `14px` / `12px` → **`4px`** (DESIGN.md: "radius kecil dan konsisten: 4px untuk panel")
- Border-radius semua tombol & input: `10px` / `8px` → **`6px`** (DESIGN.md: "6px untuk tombol dan input")
- Shadow: hapus shadow berlapis, pakai satu lapis `0 12px 32px rgba(28,43,58,0.14)` (DESIGN.md section 4)
- Typography heading: `font-weight: 800/700` → **`500`** (DESIGN.md: "Fraunces, font-weight 500")
- Semua label/text: **hapus `text-transform: uppercase`** → sentence case (DESIGN.md: "jangan pakai huruf kapital semua")
- Hero badge: dari kotak merah → **pill dengan dot** (`border-radius: 100px`, dot warna `--stamp`)
- Hapus `transform: rotateY/rotateX` dan `transition: transform 0.4s` pada card mockup (DESIGN.md: "hindari motion selain transisi hover sederhana")
- Button hover: `#9a3628` → **`var(--stamp-hover)`** (#973324)
- Step icon radius: `12px` → `4px`
- Feature icon radius: `10px` → `4px`
- Section title max size: `36px` → `30px` (DESIGN.md: "22-30px")

Konten baru:
- **Section QR code** (`#qr-code`): menampilkan visualisasi kartu dengan QR code SVG dan penjelasan fitur NFC + QR
  - Card mock dengan QR code pattern (SVG, bukan gambar)
  - List keunggulan: NFC tap, QR scan, kode unik per kartu, URL permanen
  - Section ID `#qr-code` ditambahkan ke nav
- Hapus section "NFC + QR Code" dari features (sudah dipindah ke section QR terpisah)
- Ganti feature "NFC + QR Code" dengan **"Setup hitungan detik"** di section keunggulan
- Navigasi: tambah link "QR code" di nav

Copy writing (sesuai DESIGN.md section 5 — Bahasa Indonesia santai, sentence case):
- Semua heading & label: ubah ke sentence case
- Button text: "Dapatkan Kartu" → "Dapatkan kartu", "Lihat Cara Kerja" → "Lihat cara kerja", dst.

#### `resources/views/cards/activated.blade.php`
**Perubahan besar: redesign agar sesuai DESIGN.md, khususnya motif stempel**

CSS / Visual:
- Tambah CSS variable `--stamp-hover` dan `--warning-dot`
- Border-radius ticket: `16px` → **`4px`**
- Border-radius code row: `8px` → `4px`
- Border-radius success msg: `8px` → `4px`
- Border-radius button: `10px` → **`6px`**
- Shadow: hapus shadow berlapis → `0 12px 32px rgba(28,43,58,0.14)`
- Typography heading: `font-weight: 600` → **`500`**
- Hapus semua `text-transform: uppercase` → sentence case
- Button: tetap pakai `--ink` (bukan `--stamp`) karena ini navigasi, bukan aksi ubah status (DESIGN.md section 4: "tombol primer")

Motif stempel (DESIGN.md section 4: "lingkaran outline dengan checkmark, rotate -6deg"):
- Stamp badge: dari **kotak hijau solid** → **lingkaran outline** (`border: 2.5px solid var(--success)`, `border-radius: 50%`) dengan `transform: rotate(-6deg)`
- Checkmark SVG di dalam lingkaran, warna `var(--success)`
- Dipindah ke samping kanan judul (flex layout)

Layout stub:
- Judul + subtitle di kiri, stamp di kanan (`ticket__header` flex container)
- Copy: "Kartu Teraktivasi" → "Kartu teraktivasi" (sentence case)
- Copy success msg diubah sesuai DESIGN.md: "Isi sekali saja. Setelah ini, kartu akan langsung mengarah ke halaman review kamu setiap kali ditap — permanen."

### File yang tidak diubah di sesi ini
- `resources/views/cards/activate.blade.php` — masih pakai styling lama, belum di-redesign
- `app/Http/Controllers/CardController.php` — tidak ada perubahan logic
- `routes/web.php` — tidak ada perubahan route

---

## 2026-09-09 — Halaman konfirmasi aktivasi + route `/aktivasi/{code}/selesai`

### File yang diubah

#### `app/Http/Controllers/CardController.php`
- Tambah method `activated(string $code)` — menampilkan halaman konfirmasi pasca-aktivasi
- Method `activate()`: redirect target diubah dari `cards.activate.form` (dengan flash message) → **`cards.activated`** (halaman konfirmasi terpisah)

#### `routes/web.php`
- Tambah route: `GET /aktivasi/{code}/selesai` → `CardController@activated`, nama route `cards.activated`

#### `resources/views/cards/activated.blade.php`
- **File baru** — halaman konfirmasi pasca-aktivasi
- Menampilkan: badge "Aktif", kode kartu, ringkasan (usaha, link review, tanggal aktivasi), tombol buka link review

---

## Catatan untuk perubahan selanjutnya

Halaman yang belum di-redesign sesuai DESIGN.md:
- `resources/views/cards/activate.blade.php` — masih pakai styling lama (system-ui, tanpa Fraunces/Inter, tanpa tema tiket)

Fitur yang belum dibangun (lihat ringkasan proyek):
- Autentikasi user (Laravel Breeze)
- Dashboard admin (generate batch + status kartu)
- Generator QR code sungguhan (package `simplesoftwareio/simple-qrcode`)
- Rate limiting di route aktivasi
