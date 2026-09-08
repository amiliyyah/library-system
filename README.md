# Library System

## Description
Simple Library Information System built with Laravel. This project is developed as part of the Pemrograman Web Framework (SYS61645) course assignment at Universitas Singaperbangsa Karawang.

## Requirements
- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Laravel 10.x

## Installation

1. Clone this repository
   ```bash
   git clone https://github.com/<username>/library-system.git
   cd library-system
   ```

2. Install dependencies via Composer
   ```bash
   composer install
   ```

3. Copy the `.env.example` file to `.env` and configure it
   ```bash
   cp .env.example .env
   ```

4. Generate the application key
   ```bash
   php artisan key:generate
   ```

5. Create a new MySQL database named `library-system` (via phpMyAdmin), then set the database configuration in `.env`
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=library-system
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Run the database migration
   ```bash
   php artisan migrate
   ```

7. Run the application
   ```bash
   php artisan serve
   ```

8. Open the application in your browser
   ```
   http://127.0.0.1:8000/
   ```

## Author
Amilia Hesty Ramadhani - 2410631250003

