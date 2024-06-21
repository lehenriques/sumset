<?php

namespace Database\Seeders;

use App\Models\Tall;
use Illuminate\Database\Seeder;

class TallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $talls = include('db/talls.php');

        foreach ($talls as $tall) {
            Tall::create($tall);
        }
    }
}
