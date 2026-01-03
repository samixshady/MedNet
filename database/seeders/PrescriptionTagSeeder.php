<?php

namespace Database\Seeders;

use App\Models\PrescriptionTag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PrescriptionTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Eye', 'color' => '#3b82f6'],
            ['name' => 'Dental', 'color' => '#ec4899'],
            ['name' => 'Cardiac', 'color' => '#ef4444'],
            ['name' => 'Diabetes', 'color' => '#f59e0b'],
            ['name' => 'Skin', 'color' => '#06b6d4'],
            ['name' => 'ENT', 'color' => '#8b5cf6'],
            ['name' => 'Orthopedic', 'color' => '#14b8a6'],
            ['name' => 'General', 'color' => '#6b7280'],
        ];

        // Add tags for each user (only if they don't exist)
        $users = User::all();
        foreach ($users as $user) {
            foreach ($tags as $tag) {
                // Check if tag already exists for this user
                $exists = PrescriptionTag::where('user_id', $user->id)
                    ->where('name', $tag['name'])
                    ->exists();
                
                if (!$exists) {
                    PrescriptionTag::create([
                        'user_id' => $user->id,
                        'name' => $tag['name'],
                        'color' => $tag['color'],
                    ]);
                }
            }
        }
    }
}
