<?php

namespace Database\Seeders;

use App\Models\Fruit;
use Illuminate\Database\Seeder;

class FruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fruits = ['تفاح', 'برتقال', 'موز', 'مانجو'];

        foreach ($fruits as $fruit) {
            Fruit::firstOrCreate(['name' => $fruit]);
        }
    }
}
