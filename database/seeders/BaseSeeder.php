<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

abstract class BaseSeeder extends Seeder
{
    /**
     * Run the seeder safely.
     */
    protected function safeRun(string $table, array $data): void
    {
        try {
            DB::table($table)->truncate();
            foreach (array_chunk($data, 100) as $chunk) {
                DB::table($table)->insert($chunk);
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Generate a random order number.
     */
    protected function generateOrder(int $min = 1, int $max = 100): int
    {
        return rand($min, $max);
    }

    /**
     * Toggle visibility randomly.
     */
    protected function randomVisibility(int $truePercentage = 80): bool
    {
        return rand(1, 100) <= $truePercentage;
    }

    /**
     * Generate a random rating.
     */
    protected function generateRating(int $min = 3, int $max = 5): int
    {
        return rand($min, $max);
    }
}