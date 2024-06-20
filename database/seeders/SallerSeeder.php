<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Saller;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SallerSeeder extends Seeder
{

    public function run(): void
    {

        $fake = Factory::create();

        $admins = Admin::where('type' , 'saller')->get();

        foreach ($admins as $admin) {

            Saller::create([
                'admin_id'         => $admin->id ,
                'name'             => $admin->name ,
                'email'            => $admin->email ,
                'first_name'       => $fake->firstName() ,
                'last_name'        => $fake->lastName() ,
                'country_id'       => rand(1,4) ,
                'city_id'          => rand(1,12) ,
                'region'           => $fake->text(15) ,
                'address'          => $fake->address() ,
                'address_2'        =>$fake->address(),
                'company'          => $fake->firstName() ,
                'phone'            => $fake->phoneNumber() ,
                'img'              => 'sallers/' . rand(1,4) . '.png' ,
                'logo'             => 'sallers/logo.png' ,
                'is_active'        => rand(0,1)
            ]);
        }


    }
}
