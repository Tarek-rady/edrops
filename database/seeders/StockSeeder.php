<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{

    public function run(): void
    {
        for ($i=1; $i < 11 ; $i++) {

            Stock::create([
                'name_ar'      => 'المستودع رقم ' . $i ,
                'name_en'      => 'Stock Number '. $i  ,
                'link'         => 'link' ,
                'country_id'   => 1 ,
                'city_id'      => rand(1,3) ,

            ]);
        }

        for ($i=12; $i < 22 ; $i++) {

            Stock::create([
                'name_ar'      => 'المستودع رقم ' . $i ,
                'name_en'      => 'Stock Number '. $i  ,
                'link'         => 'link' ,
                'country_id'   => 2 ,
                'city_id'      => rand(4,6) ,

            ]);
        }

        for ($i=23; $i < 33 ; $i++) {

            Stock::create([
                'name_ar'      => 'المستودع رقم ' . $i ,
                'name_en'      => 'Stock Number '. $i  ,
                'link'         => 'link' ,
                'country_id'   => 3 ,
                'city_id'      => rand(7,9) ,

            ]);
        }


        for ($i=34; $i < 44 ; $i++) {

            Stock::create([
                'name_ar'      => 'المستودع رقم ' . $i ,
                'name_en'      => 'Stock Number '. $i  ,
                'link'         => 'link' ,
                'country_id'   => 4 ,
                'city_id'      => rand(10,12) ,

            ]);
        }
    }
}
