<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user){
        return $user->is_admin;
    }
    public function update(User $user, Task $task){
        return in_array($user->role_id,[Role::IS_ADMIN,Role::IS_MANAGER]) || (auth()->check() && $task->author == auth()->user()->name) ; // we can user edit tasks belong of him
    }

    public function delete(User $user, Task $task){
        return  $user->role_id == Role::IS_USER || (auth()->check() && $task->author == auth()->user()->name) ;;
    }
}
