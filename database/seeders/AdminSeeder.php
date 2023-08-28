<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'M Umar Habib',
            'email'=> 'mumarhabibrb102@gmail.com',
            'password'=> Hash::make('123'),
        ]);
    }
}
