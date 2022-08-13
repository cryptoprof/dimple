<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\TaskFilter;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaskFilter $filter)
    {
        //
        return Task::filter($filter)->with('assignees')->orderByDesc('id')->paginate(10)->toJson();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        //
        $task = Task::create($request->validated());
        $task->assignees()->sync($request->usersIds);
        $task->save();
        return $task;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Task::findOrFail($id);
    }

    public function update(TaskUpdateRequest $request, $id)
    {
        $project = Task::findOrFail($id);
        $project->update($request->validated());
        return $project;
    }


    public function destroy($id)
    {
        $project = Task::findOrFail($id);
        $project->delete();
        return '';
    }
}
