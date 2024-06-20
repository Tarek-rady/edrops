<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Order;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{

    public function run(): void
    {
        $fake = Factory::create();

        for ($i=1; $i < 100 ; $i++) {

            Order::create([
                'code'                  => rand(10000 , 99999) ,
                'address'               => 'address' ,
                'saller_id'               => rand(1 , 12) ,
                'status_id'             => rand(1,7) ,
                'order_code'            => $fake->unique()->numberBetween(1000 , 9999) ,
                'payment_method'        => 'cash' ,
                'date_order'            => now()->addDays(5) ,
                'type'                  => 'order' ,
                'customer_name'         => $fake->name() ,
                'country'               => 'country' ,
                'city'                   => 'city' ,
                'country_code'           => '2324' ,
                'phone'                  => $fake->phoneNumber() ,
                'total_products_cost'    => rand(1,100) ,
                'shipping_tax'           => rand(1,100) ,
                'customer_total_cost'    => rand(1,100) ,
                'service_cost'           => rand(1,100) ,
                'saller_total_profit'    => rand(1,100) ,
                'created_at'            => now() ,
            ]);
        }



        $orders = Order::get();

        foreach ($orders as $order) {

            for ($i=1; $i < 4 ; $i++) {

                $order->items()->create([
                    'product_id'            => rand(1,16) ,
                    'qty'                   => rand(1,4) ,
                    'product_cost_price'    => rand(50 , 100),
                    'product_selling_price' => rand(50 , 100),
                    'total'                 => rand(50 , 100),
                    'created_at'       => now() ,
                ]);

            }
        }

    }
}
