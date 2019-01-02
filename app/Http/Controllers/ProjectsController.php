<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = $this->list();
        return view('projects.index', compact('projects'));
    }

    public function list() {
        return Project::all();
    }

    public function store()
    {
        // foreceCreate will avoid mass assignments check
        $attributes = request()->validate([
            'name' => 'required|min:3',
            'description' => 'required'
        ]);
        Project::forceCreate($attributes);
        return [
            'message' => 'Project created!',
            'data' => $attributes
        ];
    }
}
