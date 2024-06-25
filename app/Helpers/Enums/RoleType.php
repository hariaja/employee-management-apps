<?php

namespace App\Helpers\Enums;

use App\Traits\EnumsToArray;

enum RoleType: string
{
  use EnumsToArray;

  case ADMIN = 'Super Admin';
  case HR = 'Admin HR';
  case Employee = 'Karyawan';
}
