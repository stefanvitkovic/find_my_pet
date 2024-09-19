<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Animal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductSeeder::class);

        \App\Models\User::factory()->create([
            'name' => 'superadmin',
            'username' => 'superadmin',
            'email' => 'test@paws.com',
            'password' => Hash::make('password'),
            'admin' => 1,
            'superadmin' => 1,
            'status' => 1
        ]);

        $animals = [
            'Dog',
            'Cat',
            'Pig',
            'Rabbit',
            'Chicken',
            'Bird',
            'Horse',
            'Other',
        ];

        foreach ($animals as $animal) {
            Animal::create(['name'=>$animal]);
        }

    }
}
