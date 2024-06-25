<?php

namespace App\Repositories\Permission;

use LaravelEasyRepository\Repository;

interface PermissionRepository extends Repository
{
  public function getQuery();
  public function getWhere(
    $wheres = [],
    $columns = '*',
    $comparisons = '=',
    $orderBy = null,
    $orderByType = null
  );
}
