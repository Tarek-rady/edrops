<?php

namespace Database\Seeders;

use App\Models\Country;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{

    public function run(): void
    {

        Country::insert([

            [

                'name_ar'    => 'الاردن' ,
                'name_en'    => 'Jordan' ,
                'phone_key'  => '962' ,
                'img'        => 'countries/2.png' ,
                'delivery'   => 10 ,
                'time'       => 24 ,
                'created_at' => now() ,
            ] ,

            [

                'name_ar'    => 'السعوديه' ,
                'name_en'    => 'Saudi Arabia' ,
                'phone_key'  => '966' ,
                'img'        => 'countries/1.png' ,
                'delivery'   => 15 ,
                'time'       => 24 ,
                'created_at' => now() ,
            ] ,




            [

                'name_ar'    => 'الامارات' ,
                'name_en'    => 'The UAE' ,
                'phone_key'  => '971' ,
                'img'        => 'countries/4.png' ,
                'delivery'   => 20 ,
                'time'       => 24 ,
                'created_at' => now() ,
            ] ,

            [

                'name_ar'    => 'الكويت' ,
                'name_en'    => 'Kuwait' ,
                'phone_key'  => '965' ,
                'img'        => 'countries/3.png' ,
                'delivery'   => 15 ,
                'time'       => 24 ,
                'created_at' => now() ,
            ] ,



        ]);


        $countries = Country::get();
        $fake = Factory::create();

        foreach ($countries as $country) {
            $country->wallets()->create([
               'name_ar' => $fake->firstName() ,
               'name_en' => $fake->firstName() ,
            ]);
        }
    }
}




