<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\projects;
use App\Models\tasks;
use App\Models\User;

class ProjectContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows= projects::all();
        return response()->json($rows);
        if (!$rows) {
             return response()->json(['message'=>'could not find any resource'], 404);
        }
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'name' => 'required|max:25|string',
            'description' => 'required|max:1000|string',
            'notes' => 'nullable|string|max:500'
        ]);
        
        $newProject = projects::create([
            'user_id'=> $request->user()->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'notes'=>$request->notes
        ]);

        if (!$newProject) {
            return response()->json([
                'message' => 'could not create project'
            ], 500);
        }

        return response()->json(['message'=> 'project succesfully added',
        'project'=> $newProject
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(projects $project)
    {
        $project= projects::find($id);

        if (!$project) {
            return response()->json([
            'name'=> 'could not find specified project'
        ], 404);
        }

        return response()->json([
            'name'=> $project->name,
            'description'=> $project->description,
            'notes'=> $project->notes,
        ], 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
