<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\CustomerFilter;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CustomersController extends Controller
{
    protected $model;

    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerFilter $filter)
    {
        //
        return Customer::filter($filter)->orderByDesc('id')->paginate(10)->toJson();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        //
        $user = Customer::create($request->validated());
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Customer::where('id', $id)->with('comments')->first();
    }

    public function update(CustomerUpdateRequest $request, $id)
    {
        $project = Customer::findOrFail($id);
        $project->update($request->validated());
        return $project;
    }


    public function destroy($id)
    {
        $project = Customer::findOrFail($id);
        $project->delete();
        return '';
    }

    public function tasks($id)
    {
        $customer = Customer::where('id', $id)->with(['comments','comments.user'])->first();
        $customerWithTasks = $customer->tasks()->with('assignees')->orderByDesc('id')->paginate(10);
        return ['customer' => $customer, 'tasks' => $customerWithTasks];
    }
}
