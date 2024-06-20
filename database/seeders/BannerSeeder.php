<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{

    public function run(): void
    {
        Banner::insert([

            [
                'title_ar' => 'كاش يصل حتي ' . '60%' ,
                'title_en' => 'Cash up to' . '60%'  ,
                'link'     => 'https://translate.google.com/' ,
                'status'   => 'active' ,
                'img' => 'banners/1.jpg' ,
                 'desc_ar' => 'هذا النص هو مثال لنص يمكن استبداله في نفس المساحه لقد تم توليد هذا النص من مولد النص العربي',
                'desc_en' => 'This text is an example of text that can be replaced in the same space. This text was generated from the Arabic text generator',

                'created_at' => now()
            ],

            [
                'title_ar' => 'كاش يصل حتي ' . '50%' ,
                'title_en' => 'Cash up to' . '50%'  ,
                'link'     => 'https://translate.google.com/' ,
                'status'   => 'active' ,
                'img' => 'banners/2.jpg' ,
                                 'desc_ar'            => 'هذا النص هو مثال لنص يمكن استبداله في نفس المساحه لقد تم توليد هذا النص من مولد النص العربي',

                'desc_en'            => 'This text is an example of text that can be replaced in the same space. This text was generated from the Arabic text generator',

                'created_at' => now()
            ],


            [
                'title_ar' => 'كاش يصل حتي ' . '40%' ,
                'title_en' => 'Cash up to' . '40%'  ,
                'link'     => 'https://translate.google.com/' ,
                'status'   => 'active' ,
                'img' => 'banners/3.jpg' ,
                                 'desc_ar'            => 'هذا النص هو مثال لنص يمكن استبداله في نفس المساحه لقد تم توليد هذا النص من مولد النص العربي',

                'desc_en'            => 'This text is an example of text that can be replaced in the same space. This text was generated from the Arabic text generator',

                'created_at' => now()
            ],

            [
                'title_ar' => 'كاش يصل حتي ' . '30%' ,
                'title_en' => 'Cash up to' . '30%'  ,
                'link'     => 'https://translate.google.com/' ,
                'status'   => 'active' ,
                'img' => 'banners/4.jpg' ,
                                 'desc_ar'            => 'هذا النص هو مثال لنص يمكن استبداله في نفس المساحه لقد تم توليد هذا النص من مولد النص العربي',

                'desc_en'            => 'This text is an example of text that can be replaced in the same space. This text was generated from the Arabic text generator',

                'created_at' => now()
            ],



        ]);
    }
}
