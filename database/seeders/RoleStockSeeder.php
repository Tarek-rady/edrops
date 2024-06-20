<?php

namespace Database\Seeders;

use App\Models\RoleStock;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleStockSeeder extends Seeder
{

    public function run(): void
    {
        $stocks = Stock::get();


            foreach ($stocks as $stock) {

                RoleStock::create([
                   'role_id'  => 1 ,
                   'stock_id' => $stock->id
                ]);



        }
    }
}
