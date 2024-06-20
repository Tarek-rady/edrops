<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{

    public function run(): void
    {
        $fake = Factory::create();

        for ($i=1; $i < 10 ; $i++) {
           User::create([
                'name'                => $fake->name() ,
                'email'               => $fake->unique()->email() ,
                'phone'               => $fake->unique()->phoneNumber() ,
                'img'                 => 'users/' . rand(1,5) . '.png' ,
                'password'            => Hash::make('password') ,
                'email_verified_at'   => now() ,
                'country_id'          => 1 ,
                'city_id'             => rand(1,3) ,
                'company'             => $fake->firstName() ,
                'is_active'           => rand(0,1) ,
                'code'                => Str::random(13) ,
                'created_at'          => now() ,
           ]);
        }

        for ($i=11; $i < 21 ; $i++) {
            User::create([
                 'name'                => $fake->name() ,
                 'email'               => $fake->unique()->email() ,
                 'phone'               => $fake->unique()->phoneNumber() ,
                 'img'                 => 'users/' . rand(1,5) . '.png' ,
                 'password'            => Hash::make('password') ,
                 'email_verified_at'   => now() ,
                 'country_id'          => 2 ,
                 'city_id'             => rand(4,6) ,
                 'company'             => $fake->firstName() ,
                 'is_active'           => rand(0,1) ,
                 'code'                => Str::random(13) ,
                 'created_at'          => now() ,

            ]);
         }

        for ($i=22; $i < 31 ; $i++) {
            User::create([
                 'name'                => $fake->name() ,
                 'email'               => $fake->unique()->email() ,
                 'phone'               => $fake->unique()->phoneNumber() ,
                 'img'                 => 'users/' . rand(1,5) . '.png' ,
                 'password'            => Hash::make('password') ,
                 'email_verified_at'   => now() ,
                 'country_id'          => 3 ,
                 'city_id'             => rand(7,9) ,
                 'company'             => $fake->firstName() ,
                 'is_active'           => rand(0,1) ,
                 'code'                => Str::random(13) ,
                 'created_at'          => now() ,

            ]);
        }
    }
}
