<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::query()->updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator Sekolah',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
