<?php

namespace Database\Seeders;

use App\Models\Point;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{

    public function run(): void
    {
        Point::insert([

            [
                'name_ar'    => 'البروزني' ,
                'name_en'    => 'Bronze' ,
                'created_at' => now() ,
            ] ,

            [
                'name_ar'    => 'الفضي' ,
                'name_en'    => 'silver' ,
                'created_at' => now() ,
            ] ,


            [
                'name_ar'    => 'الذهبي' ,
                'name_en'    => 'gold' ,
                'created_at' => now() ,
            ] ,


        ]);
    }
}


