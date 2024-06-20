<?php

namespace Database\Seeders;

use App\Models\Admin;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class AdminSeeder extends Seeder
{

    public function run()
    {

        $fake = Factory::create();

        $owner = Admin::create([
                'name' => 'admin' ,
                'email' => 'admin@yahoo.com' ,
                'img' => 'admins/1.png' ,
                'email_verified_at' => now() ,
                'password' => bcrypt('password') ,
                'remember_token'=>Str::random(10),
                'type'   => 'admin' ,
                'created_at'=>now(),
        ]);
        $owner->syncRoles(['admin' => 1]);

           for ($i=2; $i <20 ; $i++) {
                $admin = Admin::create([
                    'name' =>$fake->name() ,
                    'email' => $fake->unique()->email() ,
                    'img' => 'admins/1.png' ,
                    'email_verified_at' => now() ,
                    'password' => bcrypt('password') ,
                    'remember_token'=>Str::random(10),
                    'type'   => 'admin' ,
                    'created_at'=>now(),
                ]);

                $owner->syncRoles(['admin' => 1]);
            }

            for ($i=21; $i <34 ; $i++) {
                $admin = Admin::create([
                    'name' =>$fake->name() ,
                    'email' => $fake->unique()->email() ,
                    'img' => null ,
                    'email_verified_at' => now() ,
                    'password' => bcrypt('password') ,
                    'remember_token'=>Str::random(10),
                    'type'   => 'saller' ,
                    'created_at'=>now(),
                ]);

            }

    }
}
