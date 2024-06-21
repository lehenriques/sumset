<?php

namespace Database\Seeders;

use App\Models\Wide;
use Illuminate\Database\Seeder;

class WideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wides = include('db/wides.php');

        foreach ($wides as $wide) {
            Wide::create($wide);
        }
    }
}
