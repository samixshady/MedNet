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
            'products/xXpzM80YAEOq0MALbhcJUvzMbFinMLLMnSCQr1oP.jpg',
            'products/qiiqrhhMOMke5W9Q10sZfkWCZ59O5cquqWVAuBUi.png',
            'products/ZiUDFpNhr1XalANPqyB4cuVzeeJExwG21JQKw5Uj.png',
            'products/iyHGxXRFmpLlWkbGRhtMoCyHcI9kqAEbFUvpparc.png',
            'products/siLr9n6yeJlEF0VyYJKm3zCDynSRAozfVmYvHrzG.png',
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
