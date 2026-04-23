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
        $fruits = [
            'تفاح',
            'برتقال',
            'موز',
            'عنب',
            'مانجو',
            'كيوي',
            'أناناس',
            'رمان',
            'شمام',
            'جوافة',
            'تين',
            'توت',
            'كرز',
            'خوخ',
            'إجاص',
        ];

        foreach ($fruits as $fruit) {
            Fruit::firstOrCreate(['name' => $fruit]);
        }
    }
}
