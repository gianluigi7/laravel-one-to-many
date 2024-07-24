<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data =$request->validated();

        $data['slug'] = Str::of($data['title'])->slug();

        $project = new Project();

        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->slug = $data['slug'];

        $project->save();

        return redirect()->route('admin.projects.index')->with('message', 'Nuovo progetto creato correttamente');
    }

    /**
     * Display the specified resource.
     */
    //public function show(string $slug)
    public function show(Project $project)
    {
       // $project = Project::where('slug', $slug)->first();
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $data['slug'] = Str::of($data['title'])->slug();


        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->slug = $data['slug'];

        $project->save();
        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
