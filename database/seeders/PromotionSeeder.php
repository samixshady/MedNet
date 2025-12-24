<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use Illuminate\Support\Facades\File;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing promotions
        Promotion::truncate();

        // Source directory for promo images
        $sourceDir = resource_path('images/medicine image/Promos');
        $targetDir = storage_path('app/public/promotions');

        // Create target directory if it doesn't exist
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        // Define promo images
        $promoImages = [
            ['file' => 'promo1.png', 'title' => 'Special Discount', 'description' => 'Get amazing discounts on select medicines'],
            ['file' => 'promo2.jpg', 'title' => 'Health Products', 'description' => 'Quality health products at great prices'],
            ['file' => 'promo3.jpg', 'title' => 'Wellness Essentials', 'description' => 'Your wellness journey starts here'],
            ['file' => 'promo4.png', 'title' => 'Medical Supplies', 'description' => 'Trusted medical supplies delivered'],
            ['file' => 'promo5.png', 'title' => 'Healthcare Deals', 'description' => 'Exclusive healthcare deals this month'],
            ['file' => 'promo6.png', 'title' => 'Medicine Offers', 'description' => 'Special offers on prescription medicines'],
        ];

        foreach ($promoImages as $index => $promo) {
            $sourceFile = $sourceDir . '/' . $promo['file'];
            
            if (File::exists($sourceFile)) {
                // Copy file to storage
                $targetFile = $targetDir . '/' . $promo['file'];
                File::copy($sourceFile, $targetFile);

                // Create promotion record
                Promotion::create([
                    'image_path' => 'promotions/' . $promo['file'],
                    'title' => $promo['title'],
                    'description' => $promo['description'],
                    'alt_text' => $promo['title'],
                    'is_active' => true,
                    'display_order' => $index + 1,
                ]);

                $this->command->info("Added promotion: {$promo['title']}");
            } else {
                $this->command->warn("File not found: {$sourceFile}");
            }
        }

        $this->command->info('Promotion seeder completed successfully!');
    }
}
