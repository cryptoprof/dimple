<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function index(UserFilter $filter)
    {
        return User::filter($filter)->paginate(10)->toJson();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        $user->roles()->detach();
        $user->assignRole($request->role);
        return $user;
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole($request->role);
        return $user;
    }

    public function destroy($id)
    {
        $project = User::findOrFail($id);
        $project->delete();
        return '';
    }

}
