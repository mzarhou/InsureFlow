<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
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
        User::create([
            "name" => $this->command->ask("Name: "),
            "email" => $this->command->ask("Email: "),
            "password" => Hash::make($this->command->ask("Password: ")),
        ]);
    }
}
