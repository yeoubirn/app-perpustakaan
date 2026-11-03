# Aplikasi Perpustakaan Digital Kampus

Aplikasi perpustakaan digital berbasis Laravel untuk mengelola data buku, anggota, peminjaman, pengembalian, dan laporan transaksi perpustakaan.

## Teknologi yang Digunakan
- Laravel 12
- PHP
- PostgreSQL
- REST API

## Fitur Aplikasi
- Autentikasi dan login pengguna
- Pengelolaan data buku
- Pengelolaan data anggota
- Transaksi peminjaman dan pengembalian buku
- Dashboard informasi perpustakaan
- Laporan peminjaman

## Cara Menjalankan Aplikasi

Pastikan dependency sudah terpasang dan konfigurasi database sudah disesuaikan pada file `.env`.

Jalankan aplikasi web:

```bash
php artisan serve --port=8000
```

Jalankan API pada terminal terpisah:

```bash
php artisan serve --port=8011
```

Akses aplikasi melalui:

http://127.0.0.1:8000

## Dokumentasi Demo

Dokumentasi pengujian aplikasi dapat dilihat pada file [DEMO.md](DEMO.md).

## License

Aplikasi ini dikembangkan untuk keperluan praktikum.
