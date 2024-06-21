<?php

namespace Database\Seeders;

use App\Models\Exchange;
use Illuminate\Database\Seeder;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exchanges = include('db/exchanges.php');

        foreach ($exchanges as $exchange) {
            Exchange::create($exchange);
        }
    }
}
