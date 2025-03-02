<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Backend Setup

## 🏗️ Backend: Laravel Setup

### 1️⃣ Clone the Laravel Backend Repository
```sh
git clone https://github.com/oyatmicah/appointmentSystemBE.git
cd appointmentSystemBE
```

### 2️⃣ Install Dependencies
```sh
composer install
```

### 3️⃣ Set Up Environment File
Copy the `.env.example` file and rename it to `.env`:
```sh
cp .env.example .env
```

### 4️⃣ Generate Application Key
```sh
php artisan key:generate
```

### 5️⃣ Configure Database
Edit the `.env` file and update the database settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6️⃣ Run Database Migrations
```sh
php artisan migrate --seed
```
_This will create the necessary tables and seed some default data._

_a super admin gets automatically seeded with the credential. email(admin@admin.com), password(admin1234)_

### 7️⃣ Run the Laravel Server
```sh
php artisan serve
```
_This will start the backend on `http://127.0.0.1:8000`._

