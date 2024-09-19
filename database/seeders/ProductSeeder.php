<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = [
            [
                'name' => 'Pametni NFC Tag',
                'price' => 2500,
                'discount_price' => 1500,
                'description' => 'Pametni NFC Tag za vaseg ljubimca!',
                'image' => 'https://pametnesape.com/images/sapa.png'
            ]
        ];
        Product::insert($products);

    }
}
