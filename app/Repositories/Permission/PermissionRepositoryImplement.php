<?php

namespace App\Repositories\Permission;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Permission;

class PermissionRepositoryImplement extends Eloquent implements PermissionRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   */
  public function __construct(
    protected Permission $model
  ) {
    // 
  }

  /**
   * Get default query
   */
  public function getQuery()
  {
    return $this->model->query();
  }

  /**
   * Get data by row name use where or where in function
   */
  public function getWhere(
    $wheres = [],
    $columns = '*',
    $comparisons = '=',
    $orderBy = null,
    $orderByType = null
  ) {
    $data = $this->model->select($columns);

    if (!empty($wheres)) {
      foreach ($wheres as $key => $value) {
        if (is_array($value)) {
          $data = $data->whereIn($key, $value);
        } else {
          $data = $data->where($key, $comparisons, $value);
        }
      }
    }

    if ($orderBy) {
      $data = $data->orderBy($orderBy, $orderByType);
    }

    return $data;
  }
}
