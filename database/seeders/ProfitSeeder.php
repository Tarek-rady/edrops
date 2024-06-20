<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Profit;
use App\Models\Pull;
use App\Models\Saller;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfitSeeder extends Seeder
{

    public function run(): void
    {
        $orders = Order::where('status_id' , 6 )->get();
        $randomDate = Carbon::now()->subDays(rand(0, 365));


        foreach ($orders as $order) {


           Profit::create([
                'saller_id'    => $order->saller_id ,
                'order_id'     => $order->id ,
                'admin_id'     => rand(1,3) ,
                'profit'       => rand(10 , 30) ,
                'created_at'   => $randomDate,
                'type'         => 'saller' ,
            ]);
        }





        $sallers = Saller::get();

        foreach ($sallers as $saller) {
            Pull::create([
                'saller_id'    => $saller->id ,
                'admin_id'     => rand(1,3) ,
                'pull'         => rand(10 , 50) ,
                'type'         => 'saller'

            ]);
        }

    }
}
