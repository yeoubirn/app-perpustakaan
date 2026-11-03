# Dokumentasi REST API - Perpustakaan Digital Kampus

Base URL (development): `http://127.0.0.1:8000/api`

Semua request wajib menyertakan header:

```
Accept: application/json
```

Request `POST` dan `PUT` mengirim body JSON (`Content-Type: application/json`).

> Endpoint sengaja dibiarkan publik (tanpa autentikasi) di pertemuan ini.
> Response error di bawah hanya menampilkan status code dan `message`. Saat `APP_DEBUG=true`, Laravel juga menyertakan `exception`, `file`, `line`, dan `trace` yang sengaja tidak ditulis di sini.

## Ringkasan Endpoint

| No | Method | URL | Body | Status Sukses | Status Gagal |
|----|--------|-----|------|---------------|--------------|
| 1 | GET | `/api/books` | - | 200 | - |
| 2 | GET | `/api/books/{id}` | - | 200 | 404 |
| 3 | POST | `/api/books` | JSON buku | 201 | 422 |
| 4 | PUT | `/api/books/{id}` | JSON buku | 200 | 404, 422 |
| 5 | DELETE | `/api/books/{id}` | - | 200 | 404 |
| 6 | GET | `/api/members` | - | 200 | - |
| 7 | GET | `/api/members/{id}` | - | 200 | 404 |
| 8 | GET | `/api/loans` | - | 200 | - |
| 9 | POST | `/api/loans` | JSON peminjaman | 201 | 422 |
| 10 | PUT | `/api/loans/{id}/kembalikan` | - | 200 | 404 |
| 11 | GET | `/api/stats` | - | 200 | - |

---

## Books

### 1. GET /api/books

Daftar buku, 10 per halaman. Filter opsional lewat query string:

- `?judul=` pencarian sebagian pada judul
- `?category_id=` pencocokan persis kategori
- `?page=` nomor halaman

Body: tidak ada.

**200 OK**

```json
{
    "data": [
        {
            "id": 1,
            "judul": "Buku Contoh 1",
            "penulis": "Penulis A",
            "penerbit": "Penerbit A",
            "tahun_terbit": "2020",
            "isbn": "9780000000001",
            "stok": 5,
            "sampul": null,
            "category": {
                "id": 1,
                "nama_kategori": "Novel"
            },
            "created_at": "2026-10-12T16:32:40.000000Z",
            "updated_at": "2026-10-12T16:32:40.000000Z"
        },
        {
            "id": 2,
            "judul": "Buku Contoh 2",
            "penulis": "Penulis B",
            "penerbit": "Penerbit B",
            "tahun_terbit": "2021",
            "isbn": "9780000000002",
            "stok": 3,
            "sampul": null,
            "category": {
                "id": 2,
                "nama_kategori": "Komik"
            },
            "created_at": "2026-10-12T16:32:42.000000Z",
            "updated_at": "2026-10-12T16:32:42.000000Z"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/books?page=1",
        "last": "http://127.0.0.1:8000/api/books?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/books?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/books",
        "per_page": 10,
        "to": 2,
        "total": 2
    }
}
```

### 2. GET /api/books/{id}

Detail satu buku beserta kategorinya. Body: tidak ada.

**200 OK** (`GET /api/books/1`)

```json
{
    "data": {
        "id": 1,
        "judul": "Buku Contoh 1",
        "penulis": "Penulis A",
        "penerbit": "Penerbit A",
        "tahun_terbit": "2020",
        "isbn": "9780000000001",
        "stok": 5,
        "sampul": null,
        "category": {
            "id": 1,
            "nama_kategori": "Novel"
        },
        "created_at": "2026-10-12T16:32:40.000000Z",
        "updated_at": "2026-10-12T16:32:40.000000Z"
    }
}
```

**404 Not Found** (`GET /api/books/999`)

```json
{
    "message": "No query results for model [App\\Models\\Book] 999"
}
```

### 3. POST /api/books

Membuat buku baru. Field `isbn` opsional, field lain wajib.

Body:

```json
{
    "judul": "Buku Baru",
    "penulis": "Penulis C",
    "penerbit": "Penerbit C",
    "tahun_terbit": 2024,
    "isbn": "9780000000003",
    "stok": 4,
    "category_id": 1
}
```

**201 Created**

```json
{
    "data": {
        "id": 3,
        "judul": "Buku Baru",
        "penulis": "Penulis C",
        "penerbit": "Penerbit C",
        "tahun_terbit": 2024,
        "isbn": "9780000000003",
        "stok": 4,
        "sampul": null,
        "category": {
            "id": 1,
            "nama_kategori": "Novel"
        },
        "created_at": "2026-11-03T13:51:03.000000Z",
        "updated_at": "2026-11-03T13:51:03.000000Z"
    }
}
```

**422 Unprocessable Entity** (body `{}`)

```json
{
    "message": "TODO",
    "errors": {
        "judul": [
            "Judul buku wajib diisi."
        ],
        "penulis": [
            "Nama penulis wajib diisi."
        ],
        "penerbit": [
            "Nama penerbit wajib diisi."
        ],
        "tahun_terbit": [
            "Tahun terbit wajib diisi."
        ],
        "stok": [
            "Stok wajib diisi."
        ],
        "category_id": [
            "Kategori wajib dipilih."
        ]
    }
}
```

### 4. PUT /api/books/{id}

Mengubah buku. Semua field wajib dikirim lengkap, kecuali `isbn`.

Body (`PUT /api/books/3`):

```json
{
    "judul": "Buku Baru",
    "penulis": "Penulis C",
    "penerbit": "Penerbit C",
    "tahun_terbit": 2024,
    "isbn": "9780000000003",
    "stok": 10,
    "category_id": 1
}
```

**200 OK**

```json
TODO
```

**404 Not Found** jika `{id}` tidak ada, `422 Unprocessable Entity` jika validasi gagal (bentuk error sama seperti POST /api/books).

### 5. DELETE /api/books/{id}

Menghapus buku. Body: tidak ada.

**200 OK** (`DELETE /api/books/3`)

```json
{
    "message": "Buku berhasil dihapus."
}
```

**404 Not Found** (`GET /api/books/3` setelah dihapus)

```json
{
    "message": "No query results for model [App\\Models\\Book] 3"
}
```

---

## Members

### 6. GET /api/members

Daftar anggota, 10 per halaman. Body: tidak ada.

**200 OK**

```json
TODO
```

### 7. GET /api/members/{id}

Detail satu anggota. Body: tidak ada.

**200 OK** (`GET /api/members/1`)

```json
{
    "data": {
        "id": 1,
        "nama": "Budi Santoso",
        "nim": "3125600001",
        "email": "budi@pens.ac.id",
        "nomor_telepon": "081234567890",
        "alamat": "Surabaya",
        "status": "aktif",
        "created_at": "2026-11-03T13:35:07.000000Z",
        "updated_at": "2026-11-03T13:35:07.000000Z"
    }
}
```

**404 Not Found** (`GET /api/members/999`)

```json
{
    "message": "No query results for model [App\\Models\\Member] 999"
}
```

---

## Loans

### 8. GET /api/loans

Daftar transaksi peminjaman, 10 per halaman. Body: tidak ada.

**200 OK**

```json
{
    "data": [
        {
            "id": 1,
            "member": {
                "id": 1,
                "nama": "Budi Santoso"
            },
            "petugas": {
                "id": 1,
                "name": "Admin Perpustakaan"
            },
            "tanggal_pinjam": "2026-11-03",
            "tanggal_kembali": "2026-11-10",
            "tanggal_dikembalikan": null,
            "status": "dipinjam",
            "books": [
                {
                    "id": 1,
                    "judul": "Buku Contoh 1"
                },
                {
                    "id": 2,
                    "judul": "Buku Contoh 2"
                }
            ]
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/loans?page=1",
        "last": "http://127.0.0.1:8000/api/loans?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/loans?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/loans",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

### 9. POST /api/loans

Membuat peminjaman. `user_id` (petugas) wajib dikirim di body karena API tidak memakai session login. `tanggal_kembali` tidak boleh sebelum `tanggal_pinjam`, dan `book_ids` minimal berisi satu buku.

Body:

```json
{
    "member_id": 1,
    "user_id": 1,
    "tanggal_pinjam": "2026-11-03",
    "tanggal_kembali": "2026-11-10",
    "book_ids": [1, 2]
}
```

**201 Created**

```json
{
    "data": {
        "id": 1,
        "member": {
            "id": 1,
            "nama": "Budi Santoso"
        },
        "petugas": {
            "id": 1,
            "name": "Admin Perpustakaan"
        },
        "tanggal_pinjam": "2026-11-03",
        "tanggal_kembali": "2026-11-10",
        "tanggal_dikembalikan": null,
        "status": "dipinjam",
        "books": [
            {
                "id": 1,
                "judul": "Buku Contoh 1"
            },
            {
                "id": 2,
                "judul": "Buku Contoh 2"
            }
        ]
    }
}
```

**422 Unprocessable Entity** (body `{}`)

```json
{
    "message": "Anggota wajib dipilih. (and 4 more errors)",
    "errors": {
        "member_id": [
            "Anggota wajib dipilih."
        ],
        "user_id": [
            "Petugas (user_id) wajib diisi."
        ],
        "tanggal_pinjam": [
            "Tanggal pinjam wajib diisi."
        ],
        "tanggal_kembali": [
            "Tanggal kembali wajib diisi."
        ],
        "book_ids": [
            "Pilih minimal satu buku."
        ]
    }
}
```

### 10. PUT /api/loans/{id}/kembalikan

Menandai peminjaman sebagai dikembalikan. `status` menjadi `dikembalikan` dan `tanggal_dikembalikan` diisi tanggal hari ini. Body: tidak ada.

**200 OK** (`PUT /api/loans/1/kembalikan`)

```json
{
    "data": {
        "id": 1,
        "member": {
            "id": 1,
            "nama": "Budi Santoso"
        },
        "petugas": {
            "id": 1,
            "name": "Admin Perpustakaan"
        },
        "tanggal_pinjam": "2026-11-03",
        "tanggal_kembali": "2026-11-10",
        "tanggal_dikembalikan": "2026-11-03",
        "status": "dikembalikan",
        "books": [
            {
                "id": 1,
                "judul": "Buku Contoh 1"
            },
            {
                "id": 2,
                "judul": "Buku Contoh 2"
            }
        ]
    }
}
```

**404 Not Found** (`PUT /api/loans/999/kembalikan`)

```json
{
    "message": "No query results for model [App\\Models\\Loan] 999"
}
```

---

## Stats

### 11. GET /api/stats

Ringkasan jumlah data. Body: tidak ada.

**200 OK** (saat ada satu peminjaman aktif)

```json
{
    "total_buku": 2,
    "total_anggota": 1,
    "peminjaman_aktif": 1
}
```

Setelah peminjaman dikembalikan, `peminjaman_aktif` turun menjadi `0`.
