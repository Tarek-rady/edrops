<?php

namespace Database\Seeders;

use App\Models\RoleStock;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

       $this->call(LaratrustSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PointSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(SallerSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(StockSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(TermsSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(SettingSeeder::class);
        // $this->call(StaticPageSeeder::class);
        $this->call(ContactSeede::class);
        $this->call(OrderSeeder::class);
        // $this->call(ProfitSeeder::class);
        $this->call(RoleStockSeeder::class);








    }
}
