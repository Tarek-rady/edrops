<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{

    public function run(): void
    {

        City::insert([


            [
                'name_ar'     => 'عمان' ,
                'name_en'     => 'Amman' ,
                'country_id'  => 1 ,
                'created_at'  => now() ,

            ] ,

            [
                'name_ar'     => 'إربد ' ,
                'name_en'     => 'Irbid' ,
                'country_id'  => 1 ,
                'created_at'  => now() ,

            ] ,

            [
                'name_ar'     => 'الزرقاء ' ,
                'name_en'     => 'Zarqa' ,
                'country_id'  => 1 ,
                'created_at'  => now() ,

            ] ,



            [
                'name_ar'     => 'الرياض' ,
                'name_en'     => 'Riyadh' ,
                'country_id'  => 2 ,
                'created_at'  => now() ,

            ] ,

            [
                'name_ar'     => 'جده' ,
                'name_en'     => 'Jeddah' ,
                'country_id'  => 2 ,
                'created_at'  => now() ,

            ] ,
            [
                'name_ar'     => 'مكه' ,
                'name_en'     => 'Mecca'  ,
                'country_id'  => 2 ,
                'created_at'  => now() ,

            ] ,


            [
                'name_ar'     => 'دبي' ,
                'name_en'     => 'Dubai' ,
                'country_id'  => 3 ,
                'created_at'  => now() ,

            ] ,
            [
                'name_ar'     => ' الشارقة' ,
                'name_en'     => 'Sharjah' ,
                'country_id'  => 3 ,
                'created_at'  => now() ,

            ] ,
            [
                'name_ar'     => 'ابوظبي' ,
                'name_en'     => 'Abu Dhabi' ,
                'country_id'  => 3 ,
                'created_at'  => now() ,

            ] ,

            [
                'name_ar'     => 'الأندلس' ,
                'name_en'     => 'Andalusia' ,
                'country_id'  => 4 ,
                'created_at'  => now() ,

            ] ,
            [
                'name_ar'     => 'الرقة' ,
                'name_en'     => 'Al-Raqqa' ,
                'country_id'  => 4 ,
                'created_at'  => now() ,

            ] ,
            [
                'name_ar'     => 'الصباحية' ,
                'name_en'     => 'Sabahiya' ,
                'country_id'  => 4 ,
                'created_at'  => now() ,

            ] ,


        ]);
    }
}
