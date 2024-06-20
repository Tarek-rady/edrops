<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{

    public function run(): void
    {
        Currency::insert([






            [
                'name_ar'    => 'الدولار الأمريكي' ,
                'name_en'    => 'USD' ,
                'code'       => 'USD',
                'exchange'   => 1,
                'created_at' => now() ,

            ] ,

            [
                'name_ar'    => 'الجنيه الإسترليني' ,
                'name_en'    => 'GBP' ,
                'code'       => 'GBP',
                'exchange'   => 1,
                'created_at' => now() ,

            ] ,

            [
                'name_ar'    => 'اليورو' ,
                'name_en'    => 'EUR' ,
                'code'       => 'EUR',
                'exchange'   => 1,
                'created_at' => now() ,

            ] ,


            [
                'name_ar'    => 'الجنيه المصري' ,
                'name_en'    => 'Egyptian Pound' ,
                'code'       => 'EGP',
                'exchange'   => 50,
                'created_at' => now() ,

            ] ,

            [
                'name_ar'    => 'الريال السعودي' ,
                'name_en'    => 'SR' ,
                'code'       => 'SAR',
                'exchange'   => 10,
                'created_at' => now() ,

            ] ,

            [
                'name_ar'    => 'الدينار الاردني' ,
                'name_en'    => 'JOD' ,
                'code'    => 'JOD' ,
                'exchange'   => 5,
                'created_at' => now() ,

            ] ,


        ]);
    }
}
