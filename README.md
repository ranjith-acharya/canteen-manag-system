## Canteen-Manag-System

<p align="left">
<a href="https://github.com/ranjith-acharya/canteen-manag-system" target="_blank">
    <img src="https://img.shields.io/badge/build-Canteen--Manag--System-green" alt="Canteen-Manag-System">
</a>
<a href="https://github.com/ranjith-acharya" target="_blank">
    <img src="https://img.shields.io/badge/creator-ranjith--acharya-blue" alt="Creator">
</a>
</p>

## Package used

<strong>Installing Laravel/UI</strong><br>
```bash
composer require laravel/ui
```
```bash
php artisan ui bootstrap --auth
```
```bash
npm install
```
```bash
npm run dev
```

<strong>Installing Spatie Laravel Permissions for Role</strong><br>
```bash
composer require spatie/laravel-permission
```
In Config/app.php
```php
'providers' => [
	....
	Spatie\Permission\PermissionServiceProvider::class,
],
```
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```
```bash
php artisan migrate
```