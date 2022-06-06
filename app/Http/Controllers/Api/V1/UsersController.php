<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
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
        return User::filter($filter)->paginate(10);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $company = User::findOrFail($id);
        $company->update($request->all());

        return $company;
    }

    public function store(Request $request)
    {
        $company = User::create($request->all());
        return $company;
    }

    public function destroy($id)
    {
        $company = User::findOrFail($id);
        $company->delete();
        return '';
    }

}
