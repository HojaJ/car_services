<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::insert([
             'first_name' => 'Admin',
             'last_name' => 'Admin',
             'email' => 'admin@example.com',
             'password' => bcrypt('admin'),
             'is_admin' => true,
         ]);
         Category::insert([
             'name_tm' => 'Awtoulag ýuwujy',
             'name_ru' => 'Автомойка',
             'name_en' => 'Car wash',
             'image'   => 'images/car_wash.jpg'
          ]);
        Category::insert([
            'name_tm' => 'Awtoulag abatlamak',
            'name_ru' => 'Ремонт машин',
            'name_en' => 'Car repair',
            'image'   => 'images/car_repair.jpg'
        ]);
    }
}
