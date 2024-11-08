# Test Coding Application

## Persyaratan Sistem
- PHP >= 8.1
- Composer
- Node.js dan npm
- MySQL atau database lain yang kompatibel dengan Laravel

## Instalasi
1. **Clone Repository**

```bash
git clone https://github.com/ahmad-fahrudin/test-coding.git
cd test-coding
composer install
npm install && npm run build
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut, atau menggunakan database di folder database SQL**

```bash
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```


3. **Instalasi Aplikasi**

```bash
php artisan key:generate
php artisan migrate --seed
```

4. **Jalankan Aplikasi**

```bash
php artisan serve

```
## Akun Default

-   email: admin@gmail.com
-   Password: admin123
