<?php

namespace App\Services\User;

use App\Repositories\Role\RoleRepository;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LaravelEasyRepository\ServiceApi;
use App\Repositories\User\UserRepository;

class UserServiceImplement extends ServiceApi implements UserService
{
  /**
   * set title message api for CRUD
   * @param string $title
   */
  protected $title = "";
  /**
   * uncomment this to override the default message
   * protected $create_message = "";
   * protected $update_message = "";
   * protected $delete_message = "";
   */

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */

  public function __construct(
    protected UserRepository $mainRepository,
    protected RoleRepository $roleRepository
  ) {
    // 
  }

  /**
   * Return query for model Role
   *
   */
  public function getQuery()
  {
    try {
      DB::beginTransaction();
      return $this->mainRepository->getQuery();
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
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
    try {
      DB::beginTransaction();
      return $this->mainRepository->getWhere(
        wheres: $wheres,
        columns: $columns,
        comparisons: $comparisons,
        orderBy: $orderBy,
        orderByType: $orderByType
      );
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }

  /**
   * Store data to database
   */
  public function handleStoreData($request)
  {
    try {
      DB::beginTransaction();

      // Get payload
      $payload = $request->validated();

      // Get role data
      $role = $this->roleRepository->getWhere(
        wheres: [
          'name' => $payload['roles'],
        ]
      )->first();

      $payload['password'] = bcrypt($payload['password']);

      $create = $this->mainRepository->create($payload);
      $create->assignRole($role->name);

      DB::commit();

      // Return the user
      return $create;
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }
}
