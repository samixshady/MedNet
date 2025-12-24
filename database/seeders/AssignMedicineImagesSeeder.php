<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AssignMedicineImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the medicine images with their actual extensions
        $medicineImages = [
            'medicine1.jpg',  // Blue bottle with pills
            'medicine2.png',  // Scattered pills and bottles
            'medicine3.jpg',  // Red and blue capsule
            'medicine4.png',  // Blister packs with pills
            'medicine5.jpg',  // Blue pills in bottle
        ];

        $sourceDir = resource_path('images/medicine image');
        $targetDir = storage_path('app/public/products');

        // Create target directory if it doesn't exist
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        // Copy images from resources to storage
        $this->command->info('Copying medicine images to storage...');
        foreach ($medicineImages as $image) {
            $sourceFile = $sourceDir . '/' . $image;
            $targetFile = $targetDir . '/' . $image;
            
            if (File::exists($sourceFile)) {
                File::copy($sourceFile, $targetFile);
                $this->command->info("Copied: {$image}");
            } else {
                $this->command->warn("Source file not found: {$sourceFile}");
            }
        }

        // Get all products
        $products = Product::all();
        
        if ($products->isEmpty()) {
            $this->command->warn('No products found in database!');
            return;
        }

        $this->command->info("Found {$products->count()} products. Assigning random medicine images...");

        $assignedCount = 0;

        foreach ($products as $product) {
            // Randomly select an image
            $randomImage = $medicineImages[array_rand($medicineImages)];
            
            // Update product with image path
            $product->update([
                'image_path' => 'products/' . $randomImage
            ]);

            $assignedCount++;

            // Show progress every 50 products
            if ($assignedCount % 50 === 0) {
                $this->command->info("Assigned images to {$assignedCount} products...");
            }
        }

        $this->command->info("Successfully assigned random medicine images to {$assignedCount} products!");
        $this->command->line('');
        $this->command->info('Image distribution:');
        
        // Show distribution of images
        foreach ($medicineImages as $image) {
            $count = Product::where('image_path', 'products/' . $image)->count();
            $this->command->line("  - {$image}: {$count} products");
        }
    }
}
