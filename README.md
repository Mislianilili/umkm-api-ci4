# UMKM REST API (CodeIgniter 4)

REST API CRUD data UMKM untuk praktikum Pemrograman Mobile (Topic 10).

## Endpoint

| Method | URL            | Fungsi           |
| ------ | -------------- | ---------------- |
| GET    | /api/umkm      | Ambil semua data |
| GET    | /api/umkm/{id} | Ambil satu data  |
| POST   | /api/umkm      | Tambah data      |
| PUT    | /api/umkm/{id} | Ubah data        |
| DELETE | /api/umkm/{id} | Hapus data       |

## Cara menjalankan

1. Jalankan MySQL (XAMPP) dan buat database `umkm_db`.
2. Salin `env` menjadi `.env`, lalu atur koneksi database.
3. `composer install`
4. `php spark migrate`
5. `php spark serve --host 0.0.0.0 --port 8080`

Frontend: lihat repository `umkm-app-flutter`.
