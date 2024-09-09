# Laravel Project

## Deskripsi

Proyek ini adalah aplikasi berbasis Laravel yang dirancang untuk [deskripsi singkat tentang aplikasi Anda]. Aplikasi ini bertujuan untuk [tujuan aplikasi] dan menyediakan [fitur utama aplikasi].

## Fitur Utama

- **Fitur 1**: [Deskripsi fitur 1]
- **Fitur 2**: [Deskripsi fitur 2]
- **Fitur 3**: [Deskripsi fitur 3]
- **Fitur 4**: [Deskripsi fitur 4]

## Prerequisites

Sebelum memulai, pastikan Anda telah menginstal dan mengonfigurasi hal-hal berikut:

- [PHP](https://www.php.net/downloads) (versi 8.3 atau lebih tinggi)
- [Composer](https://getcomposer.org/download/)
- [MySQL](https://dev.mysql.com/downloads/) atau [database yang sesuai]
- [Node.js](https://nodejs.org/) dan [npm](https://www.npmjs.com/get-npm) untuk pengelolaan dependensi frontend

## Instalasi

Ikuti langkah-langkah di bawah ini untuk menginstal aplikasi ini di lingkungan lokal Anda:

1. **Clone repositori**:
    ```bash
    git clone git@github.com:ilhamuket/new-shout-laravel.git
    ```

2. **Pindah ke direktori proyek**:
    ```bash
    cd new-shout-laravel
    ```

3. **Instal dependensi PHP**:
    ```bash
    composer install
    ```

5. **Salin file konfigurasi contoh**:
    ```bash
    cp .env.example .env
    ```

6. **Generate kunci aplikasi**:
    ```bash
    php artisan key:generate
    ```

7. **Jalankan migrasi database**:
    ```bash
    php artisan migrate
    ```

7. **Jalankan migrasi database**:
    ```bash
    php artisan jwt:install
    ```

8. **Jalankan seeder database (opsional)**:
    ```bash
    php artisan module:seed Auth
    ```

9. **Jalankan server pengembangan**:
    ```bash
    php artisan serve
    ```

    Akses aplikasi di `http://localhost:8000`

## Konfigurasi

- **Database**: Sesuaikan konfigurasi database di file `.env`:
    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=nama_pengguna
    DB_PASSWORD=katasandi
    ```

- **Mail**: Sesuaikan konfigurasi mail di file `.env` jika menggunakan fitur pengiriman email:
    ```plaintext
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_username
    MAIL_PASSWORD=your_password
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS=hello@example.com
    MAIL_FROM_NAME="${APP_NAME}"
    ```

## Penggunaan

- **Menambahkan Task**: Gunakan [endpoint API/fitur UI] untuk menambahkan task baru.
- **Mengedit Task**: Gunakan [endpoint API/fitur UI] untuk mengedit task yang ada.
- **Menghapus Task**: Gunakan [endpoint API/fitur UI] untuk menghapus task.

## Pengujian

Untuk menjalankan pengujian aplikasi, gunakan perintah berikut:

```bash
php artisan test
