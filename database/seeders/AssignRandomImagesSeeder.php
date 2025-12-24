<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignRandomImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'products/KDSSwheuVuyCNfC1GRVtJAOQdnNZZmGHQI6QSRCx.jpg',
            'products/OUGyIydaHThDcJEXfKdU9YShoJWjauYlPArjkmIY.png',
            'products/AYD6Qo4avMsbjAJsNylgicD0RPPWE5OU4uRRlcaO.png',
            'products/2JAFulWdGbtXviTuXtnN54MkLQnOpOUbkl4UacEs.png',
            'products/jvkhJ7uAhLJSwzvQk8dXyjDrjhz4rHcKCQMvdldU.png',
        ];

        $this->command->info('Assigning random images to products...');

        $products = DB::table('products')->get();
        $updated = 0;

        foreach ($products as $product) {
            $randomImage = $images[array_rand($images)];
            
            DB::table('products')
                ->where('id', $product->id)
                ->update(['image_path' => $randomImage]);
            
            $updated++;
        }

        $this->command->info("✓ Successfully assigned random images to {$updated} products");
    }
}
