# UAS Back-End Programming - Kelompok A06

Repositori ini untuk proyek Ujian Akhir Semester yang dibangun menggunakan Laravel Framework.
Proyek ini didasarkan pada Loyalty Apps Kedai Kopi Kita.

## Tim Pengembang

| Nama | NIM | GitHub |
|------|-----|--------|
| Vianlienra Hung | 535250012 | [@vilin-hung](https://github.com/vilin-hung) |
| Putri Agita | 535250020 | [@vioshellina](https://github.com/vioshellina) |
| Felica Marmara Putri | 535250025 | [@feli-marmar](https://github.com/feli-marmar) |
| Felicia Frederica | 535250027 | [@FeliciaFrederica](https://github.com/FeliciaFrederica) |
| Charly | 535250039 | [@Charly-437](https://github.com/Charly-437) |

## Teknologi yang Dipakai

- **Framework**: Laravel (PHP)
- **Database**: MySQL
- **Server**: Apache
- **Dependencies Management**: Composer

## Prasyarat

Pastikan sistem Anda memiliki:

- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Web Server (Apache/Nginx) atau gunakan built-in PHP server

## ⚙️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/vilin-hung/A06-LoyaltyApps.git
cd A06-LoyaltyApps
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_anda
DB_PASSWORD=password_anda
```

### 5. Migrasi Database

```bash
# Jalankan migrasi dan seeder (data awal/dummy)
php artisan migrate:fresh --seed
```

### 6. Jalankan Aplikasi

```bash
# Menjalankan aplikasi
php artisan serve

# Aplikasi akan berjalan di http://localhost:8000
```