<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    public function run(): void
    {
        Setting::create([
            'logo'            => 'setting/1.png' ,
            'twitter'         => 'twitter' ,
            'facebook'        => 'facebook' ,
            'youtube'         => 'youtube' ,
            'wattsapp'        => '001488452' ,
            'location'        => 'Amman' ,
            'email'           => 'email@yahoo.com' ,
            'gmail'           => 'gmail@yahoo.com' ,
            'type'            => 'setting' ,
            'desc_ar'         =>  'منصة إلكترونية أردنية تدعم الشباب الأردني الطموح للبدء بالعمل في التجارة الإلكترونية بدون رأس مال',
            'desc_ar'         =>  'A Jordanian electronic platform that supports ambitious Jordanian youth to start working in e-commerce without capital',
            'profit_app'      => 30 ,
            'profit_saller'   => 60 ,
            'min'             => 2 ,
            'max'             => 10 ,
        ]);
    }
}
