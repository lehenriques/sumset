<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = include('db/categories.php');

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
