# DEMO P10 — Perpustakaan Digital Kampus

## 1. Menjalankan Aplikasi

Jalankan server Laravel pada port 8000:

```bash
php artisan serve --port=8000
```

Jalankan server API pada port 8011:

```bash
php artisan serve --port=8011
```

## 2. Login

Buka browser dan akses:

http://127.0.0.1:8000/login

Gunakan akun berikut:

- Email: admin@pens.ac.id
- Password: password

## 3. Pengujian Dashboard

Setelah login, aplikasi akan menampilkan Dashboard Perpustakaan Digital Kampus.

Dashboard menampilkan statistik jumlah buku, anggota, dan peminjaman aktif.

## 4. Pengujian Laporan Peminjaman

Buka menu Laporan untuk melihat data transaksi peminjaman yang diambil dari API.

Endpoint yang digunakan:

`GET /api/loans`

## 5. Pengujian Ketika API Tidak Aktif

Matikan server API port 8011, kemudian refresh Dashboard dan Laporan.

Hasil pengujian:

- Dashboard tetap dapat dibuka.
- Statistik menampilkan angka 0.
- Laporan menampilkan tabel kosong.
- Tidak terjadi error 500.

## 6. Kesimpulan

Implementasi P10 berhasil dilakukan. Dashboard dan Laporan tetap dapat diakses meskipun server API tidak aktif.
