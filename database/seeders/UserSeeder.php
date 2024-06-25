<?php

namespace Database\Seeders;

use App\Models\User;
use App\Helpers\Enums\RoleType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Create Super Admin
    User::create([
      'name' => 'Administrator',
      'email' => 'admin@gmail.com',
      'email_verified_at' => now(),
      'password' => bcrypt('password'), // password
      'phone' => '085798888733',
    ])->assignRole(RoleType::ADMIN->value);
  }
}
