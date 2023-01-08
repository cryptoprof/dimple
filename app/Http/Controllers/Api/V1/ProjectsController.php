<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProjectFilter;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ProjectsController extends Controller
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
    public function index(ProjectFilter $filter)
    {
        //
        return Project::filter($filter)->orderByDesc('id')->paginate(10)->toJson();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        //
        $user = Project::create($request->validated());
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
        return Project::findOrFail($id);
    }

    public function update(ProjectUpdateRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->validated());
        return $project;
    }


    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return '';
    }

    public function tasks($id)
    {
        $project = Project::where('id', $id)->with(['comments', 'comments.user', 'comments.attachments'])->first();
        $projectWithTasks = $project->tasks()->with('assignees')->orderByDesc('id')->paginate(10);
        return ['project' => $project, 'tasks' => $projectWithTasks];
    }
}
