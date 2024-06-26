<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionCategory;
use App\Helpers\Enums\Permissions\PermissionCategoryList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Mengambil array dari permission category
    $datas = PermissionCategoryList::toArray();

    // Masukkan atau simpan ke database
    foreach ($datas as $name) :
      PermissionCategory::firstOrCreate([
        'name' => $name,
      ]);
    endforeach;
  }
}
