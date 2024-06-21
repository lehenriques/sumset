<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TallSeeder;
use Database\Seeders\WideSeeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\DiameterSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            DiameterSeeder::class,
            TallSeeder::class,
            WideSeeder::class,
            BrandSeeder::class,
        ]);
    }
}
