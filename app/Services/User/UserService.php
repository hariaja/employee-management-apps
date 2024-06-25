<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
  public function getQuery();
  public function getWhere(
    $wheres = [],
    $columns = '*',
    $comparisons = '=',
    $orderBy = null,
    $orderByType = null
  );
  public function handleStoreData(Request $request);
}
