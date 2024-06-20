<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
       Category::insert([
        [
            'name_ar'    => 'قسم الالكترونيات' ,
            'name_en'    => 'electronics' ,
            'img'        => 'categories/1.jpg' ,
            'type'       => 'category' ,
            'created_at' => now() ,
        ] ,

        // 2


        [
            'name_ar'    => 'قسم الادوات المنزليه' ,
            'name_en'    => 'Housewares' ,
            'img'        => 'categories/2.jpg' ,
            'type'       => 'category' ,
            'created_at' => now() ,
        ] ,

        // 3

        [
            'name_ar'    => 'قسم الملابس' ,
            'name_en'    => 'Clothes' ,
            'img'        => 'categories/3.jpg' ,
            'type'       => 'category' ,
            'created_at' => now() ,
        ] ,

        // 4

        [
            'name_ar'    => 'ديور' ,
            'name_en'    => 'Dior' ,
            'img'        => 'brands/1.png' ,
            'type'       => 'brand' ,
            'created_at' => now() ,
        ] ,

        // 5

        [
            'name_ar'    => 'شانيل' ,
            'name_en'    => 'CHANEL' ,
            'img'        => 'brands/2.png' ,
            'type'       => 'brand' ,
            'created_at' => now() ,
        ] ,
        // 6


        [
            'name_ar'    => 'زارا' ,
            'name_en'    => 'Zara' ,
            'img'        => 'brands/3.png' ,
            'type'       => 'brand' ,
            'created_at' => now() ,
        ] ,
     


       ]);
    }
}

