Pelanggan tap NFC / scan QR
        │
        ▼
GET /r/{code}  ──────────────────────────────────────────────┐
        │                                                     │
        ├─ kartu BELUM aktif                                  │
        │   └─► redirect ke GET /aktivasi/{code}              │
        │         └─► tampilkan activate.blade.php            │
        │               (form: isi nama usaha + link review)  │
        │                                                     │
        │   user submit form                                  │
        │   POST /aktivasi/{code}                             │
        │   └─► simpan ke database, status = active           │
        │         └─► redirect ke GET /aktivasi/{code}/selesai│
        │               └─► tampilkan activated.blade.php     │
        │                     (konfirmasi: "kartu sudah aktif")│
        │                                                     │
        └─ kartu SUDAH aktif                                  │
            └─► redirect langsung ke Google Review (target_url)