<?php

namespace Database\Seeders;

use App\Models\QuickBuy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuickBuyMigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder migrates existing users to have QuickBuy entries
     * and populates user_name and user_email fields
     */
    public function run(): void
    {
        // Get all QuickBuy entries
        $quickBuys = QuickBuy::whereNull('user_name')->orWhereNull('user_email')->get();

        foreach ($quickBuys as $quickBuy) {
            $user = User::find($quickBuy->user_id);
            
            if ($user) {
                // Ensure quantity is set to at least 1
                $quantity = $quickBuy->quantity ?? 1;
                
                $quickBuy->update([
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'quantity' => $quantity,
                ]);
                
                $this->command->line("Updated QuickBuy entry for user: {$user->email}");
            }
        }

        $this->command->info('QuickBuy migration completed successfully!');
        $this->command->info("Total entries updated: " . count($quickBuys));
    }
}
