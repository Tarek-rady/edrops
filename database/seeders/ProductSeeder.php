<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImg;
use App\Models\ProfitApp;
use App\Models\Rate;
use App\Models\Saller;
use App\Models\SallerProduct;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{

    public function run()
    {


        $fake = Factory::create();

        for ($i=1; $i < 300 ; $i++) {

            $cost_user = rand(10 , 15) ; // 10
            $cost = ($cost_user * 30) / 100; // 3
            $new_cost = $cost_user + $cost; // 13
            $price = ($cost * 50) / 100; // 6.5
            $new_price = $new_cost + $price ; // 19.50

            $product = Product::create([
                'category_id'        => rand(1,3) ,
                'brand_id'           => rand(4,6) ,
                'stock_id'           => rand(1,40) ,
                'name_ar'            => 'المنتج رقم ' . $i,
                'name_en'            => 'Product Number ' . $i ,
                'img'                => 'products/' . rand(1,15) . '.png' ,
                'desc_ar'            => 'هذا النص هو مثال لنص يمكن استبداله في نفس المساحه لقد تم توليد هذا النص من مولد النص العربي',
                'desc_en'            => 'This text is an example of text that can be replaced in the same space. This text was generated from the Arabic text generator',
                'cost_user'          => $cost_user ,
                'cost'               => $new_cost ,
                'price'              => $new_price ,
                'profit'             => $new_price -  $new_cost,
                'min'                => $new_price + 1 ,
                'max'                => $new_price + 10 ,
                'qty'                => rand(15 , 20) ,
                'viewer'             => rand(50 , 100) ,
                'user_id'            => rand(1,9) ,
                'sku'                => 'SA050301' . $fake->numberBetween(1000 , 9999) ,
                'stock'              => $fake->numberBetween(5 , 10) ,
                'use_product_ar'     => 'هذا النص هو مثال لنص يمكن استبداله في نفس المساحه لقد تم توليد هذا النص من مولد النص العربي' ,
                'use_product_en'     => $fake->text(200) ,
                'note_ar'            => 'هذا النص هو مثال لنص يمكن استبداله في نفس المساحه لقد تم توليد هذا النص من مولد النص العربي' ,
                'note_en'            => $fake->text(200) ,
                'populer_ar'         => 'هذا النص هو مثال لنص يمكن استبداله في نفس المساحه لقد تم توليد هذا النص من مولد النص العربي' ,
                'populer_en'         => $fake->text(200) ,
                'adv_ar'             => 'هذا النص هو مثال لنص يمكن استبداله في نفس المساحه لقد تم توليد هذا النص من مولد النص العربي' ,
                'adv_en'             => $fake->text(200) ,
                'created_at'         => now() ,
                'country_id'         => rand(1,4) ,
                'type'               => 'public' ,
                'is_active'          => rand(0,1) ,
            ]);


        }



        $products = Product::all();

        foreach ($products as $product) {

            for ($i=1; $i < 5 ; $i++) {

                ProductImg::create([
                   'product_id' => $product->id ,
                   'img'        => 'images/'.$i. '.jpg' ,
                   'type'       => 'img'
                ]);
            }
        }



        foreach ($products as $product) {

            SallerProduct::create([

                'saller_id' => rand(1,12) ,
                'product_id' => $product->id ,
                'type'       => 'products'

            ]);

        }














    }
}
