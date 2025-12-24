<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('adminadmin'),
                'is_admin' => 1,
                'is_banned' => 0,
            ]
        );

        $this->command->info('✓ Admin user created successfully!');
        $this->command->info('Email: ' . $user->email);
        $this->command->info('Password: adminadmin');
        $this->command->info('Is Admin: Yes');
    }
}
