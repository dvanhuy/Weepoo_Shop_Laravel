<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        try {
            User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345'),
                'role'=> 'admin',
            ]);
        } catch (\Throwable $th) {
        }
        
        User::factory()->count(10)->create();
    }
}
