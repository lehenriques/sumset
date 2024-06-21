<?php

namespace Database\Seeders;

use App\Models\Diameter;
use Illuminate\Database\Seeder;

class DiameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diameters = include('db/diameters.php');

        foreach ($diameters as $diameter) {
            Diameter::create($diameter);
        }
    }
}
