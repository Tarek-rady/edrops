<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{

    public function run(): void
    {
        Status::insert([
            [
                'name_ar' => 'تم الطلب' ,
                'name_en' => 'request is done' ,
            ] ,

            [
                'name_ar' => 'جاري المعالجه' ,
                'name_en' => 'Processing in progress' ,
            ] ,

            [
                'name_ar' => 'جاري التنفيذ' ,
                'name_en' => 'processing' ,
            ] ,


            [
                'name_ar' => 'تم التنفيذ' ,
                'name_en' => 'Done' ,
            ] ,


            [
                'name_ar' => 'جاري التوصيل' ,
                'name_en' => 'Delivery is in progress' ,
            ] ,


            [
                'name_ar' => 'مكتمل' ,
                'name_en' => 'Complete' ,
            ] ,

            [
                'name_ar' => 'تم الالغاء' ,
                'name_en' => 'Canceled' ,
            ] ,
        ]);
    }
}
