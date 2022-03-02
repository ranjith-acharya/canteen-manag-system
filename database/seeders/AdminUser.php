<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'card' => Str::random('16'),
            'cardcvv' => Str::random('4'),
            'email_verified_at' => Carbon::now(),
        ]);

        Role::create(['name' => 'admin']);
        $user->assignRole('admin');
        Role::create(['name' => 'customer']);

    }
}
