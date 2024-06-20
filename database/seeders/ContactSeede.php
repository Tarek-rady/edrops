<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeede extends Seeder
{

    public function run(): void
    {
        $fake = Factory::create();

        for ($i=0; $i < 20 ; $i++) {
            ContactUs::create([
                'name'         => $fake->name() ,
                'subject'      => $fake->text(10) ,
                'phone'        => $fake->phoneNumber() ,
                'email'        => $fake->email() ,
                'msg'          => $fake->text(500) ,
                'saller_id'    => rand(1,13) ,
                'user_id'      => null ,
                'type'         => 'saller'
            ]);
        }

        for ($i=21; $i < 42 ; $i++) {
            ContactUs::create([
                'name'         => $fake->name() ,
                'subject'      => $fake->text(10) ,
                'phone'        => $fake->phoneNumber() ,
                'email'        => $fake->email() ,
                'msg'          => $fake->text(500) ,
                'saller_id'    => null ,
                'user_id'      => rand(1,23) ,
                'type'         => 'user'
            ]);
        }

        for ($i=43; $i < 70 ; $i++) {
            ContactUs::create([
                'name'         => $fake->name() ,
                'subject'      => $fake->text(10) ,
                'phone'        => $fake->phoneNumber() ,
                'email'        => $fake->email() ,
                'msg'          => $fake->text(500) ,
                'saller_id'    => null ,
                'user_id'      => null ,
                'type'         => 'person'
            ]);
        }
    }
}
