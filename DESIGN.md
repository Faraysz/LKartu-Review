# Design System: Kartu Google Review

Dokumen ini jadi acuan visual untuk semua halaman di proyek ini (halaman
aktivasi, konfirmasi, dan halaman yang belum dibangun seperti dashboard
admin). Tujuannya supaya kalau ada agent/developer lain yang lanjutin,
hasilnya tetap konsisten — bukan tempelan gaya yang beda-beda tiap halaman.

## 1. Konsep

**Tiket / boarding pass yang divalidasi.** Kartu fisik ini secara literal
mirip tiket yang perlu "divalidasi" sekali sebelum bisa dipakai selamanya.
Semua elemen visual — stub kode, garis perforasi, motif stempel — menurunkan
dari metafora ini. Jangan pakai gaya generik (card SaaS serba rounded-corner
dengan shadow abu-abu, atau dashboard korporat biasa) — pertahankan nuansa
"dokumen fisik yang dicetak dan distempel" di semua halaman baru.

Nada keseluruhan: tenang, dipercaya, tidak norak. Target user-nya pemilik
usaha kecil-menengah (warung kopi, salon, dsb) yang belum tentu melek
teknis — jadi antarmuka harus jelas dan tidak butuh penjelasan tambahan.

## 2. Warna

| Token | Hex | Pemakaian |
|---|---|---|
| `--ink` | `#1C2B3A` | Teks utama, latar stub tiket, tombol primer |
| `--paper` | `#E3E6E1` | Latar belakang halaman |
| `--surface` | `#FBFAF7` | Latar kartu/panel, input field |
| `--stamp` | `#B0402E` | Aksen utama — tombol aksi penting (mis. "Aktivasi Sekarang"), warna error |
| `--stamp-hover` | `#973324` | Hover state untuk elemen `--stamp` |
| `--success` | `#3E7A5C` | Status aktif, konfirmasi, centang stempel |
| `--muted` | `#6B7268` | Teks sekunder, deskripsi, hint |
| `--line` | `#CBCFC7` | Border, garis perforasi, pembatas |
| `--warning-dot` | `#E8B74A` | Indikator status "belum aktif" (dipakai di stub tiket) |

**Aturan pemakaian:**
- `--stamp` (merah stempel) dipakai HANYA untuk satu aksi utama per halaman
  dan pesan error. Jangan dipakai untuk dekorasi atau elemen sekunder.
- `--success` dipakai untuk status "sudah beres" — badge aktif, checkmark,
  konfirmasi. Jangan dicampur dengan hijau lain.
- Latar `--paper` sengaja abu-kehijauan pudar, bukan krem hangat — hindari
  geser ke arah krem/terracotta (`#F4F1EA` / `#D97757`), itu warna default
  AI-generated yang ingin kita hindari.

## 3. Tipografi

Dua keluarga font, peran jelas berbeda:

- **Fraunces** (serif) — untuk judul/heading (`h1`, judul kartu/panel).
  Beri kesan dicetak/formal, cocok dengan nuansa tiket.
- **Inter** (sans) — untuk semua body text, label form, tombol, teks
  bantuan.

Aturan skala:
- Judul halaman: 22–30px, `font-weight: 500`
- Label form / teks kecil: 12–13px, `font-weight: 600` untuk label,
  `400` untuk body
- Jangan pakai huruf kapital semua (all-caps) untuk label — cukup sentence
  case biasa
- Baris teks deskripsi maksimal ±60-70 karakter per baris supaya nyaman
  dibaca di panel sempit

## 4. Layout & Komponen

### Prinsip umum
- Satu elemen "berani" per halaman (biasanya warna `--stamp` di satu
  tombol), sisanya tenang dan disiplin
- Border-radius kecil dan konsisten: `4px` untuk kartu/panel besar, `6px`
  untuk tombol dan input — jangan pakai radius besar ala kartu SaaS
- Shadow lembut, satu lapis: `0 12px 32px rgba(28,43,58,0.14)` — jangan
  numpuk banyak shadow

### Motif "tiket" (dipakai di halaman aktivasi)
- Panel terbagi dua: stub (latar `--ink`, berisi kode/identitas) +
  area konten (latar `--surface`, berisi form/isi utama)
- Dipisah garis perforasi: `border-left: 2px dashed var(--line)` dengan
  dua lingkaran "potongan" di ujung atas-bawah (lihat implementasi di
  `activate.blade.php`)
- Di layar sempit (<520px), stub pindah ke atas secara horizontal, garis
  perforasi berubah jadi garis putus horizontal biasa

### Form
- Input: border 1px `--line`, radius 6px, padding `11px 12px`, fokus
  ganti border jadi `--ink` (bukan outline browser default)
- Label selalu di atas input, `font-weight: 600`, ukuran 12px
- Hint/bantuan di bawah input, ukuran 11px, warna `--muted`

### Status / badge
- Badge status pakai bentuk pill (`border-radius: 100px`), dengan dot
  kecil di depan teks — dot warna sesuai status (`--warning-dot` untuk
  belum aktif, `--success` untuk aktif)

### Tombol
- Primer: latar `--ink` atau `--stamp` (pilih salah satu sesuai bobot
  aksi — `--stamp` untuk aksi yang mengubah status/data, `--ink` untuk
  aksi navigasi biasa seperti "lihat halaman review")
- Teks tombol pakai kata kerja aktif sesuai aksinya: "Aktivasi kartu
  sekarang", bukan "Submit" atau "Kirim"

### Motif "stempel" (dipakai di halaman konfirmasi)
- Lingkaran outline dengan checkmark di dalamnya, sedikit dirotasi
  (`transform: rotate(-6deg)`) untuk kesan "dicap manual"
- Dipakai hanya di momen konfirmasi keberhasilan, jangan dipakai
  berulang di tempat lain — biar tetap terasa spesial

## 5. Suara & Penulisan (copy)

- Bahasa Indonesia santai tapi jelas, hindari jargon teknis di halaman
  yang dilihat pemilik usaha (mis. jangan bilang "record", bilang "kartu")
- Instruksi to-the-point: jelaskan apa yang terjadi setelah aksi dilakukan.
  Contoh: "Isi sekali saja. Setelah ini, kartu akan langsung mengarah ke
  halaman review kamu setiap kali ditap — permanen."
- Pesan error tidak minta maaf, langsung jelaskan apa yang salah dan cara
  perbaikinya
- Nama aksi konsisten dari tombol sampai konfirmasi: tombol "Aktivasi kartu
  sekarang" → halaman hasil bilang "Kartu berhasil diaktivasi"

## 6. Aksesibilitas & Responsif

- Semua halaman harus tetap terbaca turun sampai lebar 360px
- Kontras teks terhadap latar minimal WCAG AA (kombinasi warna di atas
  sudah dicek aman: `--ink` di atas `--paper`/`--surface`, `--surface` di
  atas `--ink`)
- Fokus keyboard harus terlihat jelas (border `--ink` saat fokus pada
  input, jangan hilangkan outline tanpa pengganti)
- Hindari motion selain transisi hover sederhana — tidak ada animasi
  besar yang tidak dipicu aksi user

## 7. Untuk Halaman yang Belum Dibangun

Kalau nanti bikin dashboard admin atau halaman generate QR:
- Tetap pakai palet warna & font yang sama di atas
- Dashboard boleh lebih "biasa" (tabel, list) tapi tetap pakai warna
  `--ink`/`--paper`/`--stamp` yang sama, jangan pakai palet baru
- Kalau ada elemen tabel status kartu, badge status pakai pola pill+dot
  yang sama seperti di stub tiket (poin 4)
- Jangan tambahkan motif dekoratif baru (gradient, ilustrasi abstrak,
  ikon berlebihan) — motif tiket & stempel sudah cukup jadi identitas
  visual proyek ini