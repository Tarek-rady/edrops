<?php

namespace Database\Seeders;

use App\Models\News;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{

    public function run(): void
    {
        $fake = Factory::create();

        for ($i=1; $i < 11 ; $i++) {
           News::create([
                'title_ar' => 'عنوان الخبر رقم ' . $i ,
                'title_en' => 'Title News Number ' . $i  ,
                'admin_id'   => 1 ,
                'img' => 'news/' . rand(1,3). '.png' ,
                'desc_ar' => 'هذا النص هو مثال لنص يمكن استبداله في نفس المساحه لقد تم توليد هذا النص من مولد النص العربي',
                'desc_en' => 'This text is an example of text that can be replaced in the same space. This text was generated from the Arabic text generator',
                'created_at' => now()

           ]);
        }
    }
}
