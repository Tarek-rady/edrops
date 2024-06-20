<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Rate;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\text;

class RateSeeder extends Seeder
{

    public function run(): void
    {
        $fake = Factory::create();


        $products = Product::all();

        foreach ($products as $product) {

            for ($i=1; $i < 10 ; $i++) {
                Rate::create([
                    'product_id' => $product->id ,
                    'saller_id'  => rand(1,10) ,
                    'admin_id'   => null ,
                    'country_id' => null ,
                    'rate'       => rand(1,5) ,
                    'msg'        =>$fake->text(100) ,
                    'user_name'  => null ,
                    'type'       => 'products' ,
                    'created_at' => now() ,
                ]);
            }
        }


        for ($i=145; $i < 200 ; $i++) {
            Rate::create([
                'product_id' => null ,
                'saller_id'  => null ,
                'admin_id'   => null ,
                'country_id' => rand(1,4) ,
                'rate'       => rand(1,5) ,
                'msg'        => $fake->text(100) ,
                'user_name'  => $fake->name() ,
                'type'       => 'users' ,
                'created_at' => now() ,
            ]);
        }

        for ($i=201; $i < 250 ; $i++) {
            Rate::create([
                'product_id' => null ,
                'saller_id'  => rand(1,12) ,
                'admin_id'   => rand(1,5) ,
                'country_id' => rand(1,4) ,
                'rate'       => rand(1,5) ,
                'msg'        => $fake->text(100) ,
                'user_name'  => $fake->name() ,
                'type'       => 'sallers' ,
                'created_at' => now() ,
            ]);
        }
    }
}
