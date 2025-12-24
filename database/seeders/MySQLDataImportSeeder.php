<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MySQLDataImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sqlFile = database_path('main_mednet_db (1).sql');
        
        if (!File::exists($sqlFile)) {
            $this->command->error("MySQL file not found: {$sqlFile}");
            return;
        }

        $this->command->info("Reading MySQL dump file...");
        $sql = File::get($sqlFile);

        // Remove MySQL-specific commands that SQLite doesn't support
        $sql = preg_replace('/SET SQL_MODE.*?;/', '', $sql);
        $sql = preg_replace('/START TRANSACTION;/', '', $sql);
        $sql = preg_replace('/SET time_zone.*?;/', '', $sql);
        $sql = preg_replace('/\/\*!40\d{3}.*?\*\/;?/', '', $sql);
        $sql = preg_replace('/ENGINE=InnoDB DEFAULT CHARSET=.*?;/', ');', $sql);
        $sql = preg_replace('/COLLATE utf8mb4_unicode_ci/', '', $sql);
        $sql = preg_replace('/bigint UNSIGNED/', 'INTEGER', $sql);
        $sql = preg_replace('/bigint/', 'INTEGER', $sql);
        $sql = preg_replace('/varchar\(\d+\)/', 'TEXT', $sql);
        $sql = preg_replace('/text /', 'TEXT ', $sql);
        $sql = preg_replace('/tinyint\(1\)/', 'INTEGER', $sql);
        $sql = preg_replace('/int /', 'INTEGER ', $sql);
        $sql = preg_replace('/decimal\(\d+,\d+\)/', 'REAL', $sql);
        $sql = preg_replace('/double/', 'REAL', $sql);
        
        // Remove CREATE TABLE statements (tables already exist from migrations)
        $sql = preg_replace('/CREATE TABLE.*?\);/s', '', $sql);
        
        // Remove comments and empty lines
        $sql = preg_replace('/^--.*$/m', '', $sql);
        $sql = preg_replace('/^\s*$/m', '', $sql);

        // Split into individual INSERT statements
        $statements = array_filter(
            preg_split('/;[\s]*\n/', $sql),
            fn($stmt) => !empty(trim($stmt)) && stripos(trim($stmt), 'INSERT INTO') === 0
        );

        $this->command->info("Found " . count($statements) . " INSERT statements to process...");

        DB::beginTransaction();
        
        try {
            // Disable foreign key checks for SQLite
            DB::statement('PRAGMA foreign_keys = OFF;');
            
            // Clear existing data in correct order (respecting foreign keys)
            $this->command->info("Clearing existing data...");
            $tables = ['order_items', 'orders', 'quick_buys', 'carts', 'addresses', 'support_feedback', 'sessions', 'products', 'promotions', 'banned_emails'];
            foreach ($tables as $table) {
                try {
                    DB::table($table)->truncate();
                } catch (\Exception $e) {
                    $this->command->warn("Could not truncate {$table}: " . $e->getMessage());
                }
            }

            // Group statements by table
            $tableStatements = [];
            foreach ($statements as $statement) {
                $statement = trim($statement);
                if (empty($statement)) continue;
                
                preg_match('/INSERT INTO `?(\w+)`?/i', $statement, $matches);
                $tableName = $matches[1] ?? 'unknown';
                
                // Skip system tables
                if (in_array($tableName, ['migrations', 'cache', 'cache_locks', 'jobs', 'job_batches', 'failed_jobs', 'password_reset_tokens'])) {
                    continue;
                }
                
                if (!isset($tableStatements[$tableName])) {
                    $tableStatements[$tableName] = [];
                }
                $tableStatements[$tableName][] = $statement;
            }

            // Import in correct order
            $importOrder = ['users', 'banned_emails', 'products', 'promotions', 'addresses', 'carts', 'quick_buys', 'orders', 'order_items', 'support_feedback', 'sessions'];
            $processed = 0;
            
            foreach ($importOrder as $tableName) {
                if (!isset($tableStatements[$tableName])) {
                    continue;
                }
                
                $this->command->info("Importing data into: {$tableName}");
                
                foreach ($tableStatements[$tableName] as $statement) {
                    try {
                        // Clean up the statement for SQLite
                        $statement = str_replace('`', '', $statement);
                        
                        DB::statement($statement);
                        $processed++;
                    } catch (\Exception $e) {
                        $this->command->warn("Failed to execute statement for table {$tableName}: " . substr($e->getMessage(), 0, 200));
                    }
                }
            }

            // Re-enable foreign key checks
            DB::statement('PRAGMA foreign_keys = ON;');
            
            DB::commit();
            $this->command->info("✓ Successfully imported {$processed} tables from MySQL dump!");
            
        } catch (\Exception $e) {
            DB::rollBack();
            DB::statement('PRAGMA foreign_keys = ON;');
            $this->command->error("Failed to import data: " . $e->getMessage());
            throw $e;
        }
    }
}
