<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResetImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Resetting image paths to null...');

        // Reset product images
        $productsUpdated = DB::table('products')->update(['image_path' => null]);
        $this->command->info("✓ Reset {$productsUpdated} product images");

        // For promotions, delete all existing and let you re-add them
        // (since image_path is required and can't be null)
        $promotionsDeleted = DB::table('promotions')->delete();
        $this->command->info("✓ Deleted {$promotionsDeleted} promotions (you can re-add them with new images)");

        $this->command->info('✓ All images reset successfully! You can now upload new images.');
    }
}
