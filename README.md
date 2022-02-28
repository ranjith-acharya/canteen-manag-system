## Canteen-Manag-System

<p align="left">
<a href="https://github.com/ranjith-acharya/canteen-manag-system" target="_blank">
    <img src="https://img.shields.io/github/languages/count/ranjith-acharya/canteen-manag-system?style=plastic" alt="Language_Count">
</a>
<a href="https://github.com/ranjith-acharya" target="_blank">
    <img src="https://img.shields.io/badge/creator-ranjith--acharya-blue?style=plastic" alt="Creator">
</a>
<img src="https://img.shields.io/github/commit-activity/m/ranjith-acharya/canteen-manag-system?style=plastic" alt="Commit_Activity">
<img src="https://img.shields.io/github/last-commit/ranjith-acharya/canteen-manag-system?style=plastic" alt="Last_Commit">
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

<strong>For Notification</strong><br>
```bash
php artisan make:notification
```
```bash
php artisan migrate
```
