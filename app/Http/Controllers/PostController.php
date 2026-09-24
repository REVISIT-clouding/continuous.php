<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $rows = Post::all();
        return response()->json($rows);
       if (!$rows) {
        return response()->json(['message'=> 'Could not load'], 500);
       }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $request->validate([
        'title' => 'required|string|max:60', 'body' => 'required|string'
    ]);
        $create_post = Post::create([
            'title' => $request->title, 
            'body' => $request->body
            ]);

        if (!$create_post) {
            return response()->json(['message' => 'Failed to create post'], 500);
        }

        return response()->json([
        'message'=>'Post successfully added',
        'post' => [
            'title' => $request->title, 
            'body' => $request->body
        ]
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    // apiResource() already generates the CRUD routes,
// including GET, POST, PUT/PATCH, and DELETE.
// Adding another apiResource with {id} is unnecessary.
    {

//    $post = Post::findOrFail($id);  no need for this anymore.
   #id came from the url remember still does, just post is in place for post and id

        $request->validate([
            'title'=> 'required|max:60|string',
            'body'=> 'required|string'
        ]);

        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();
    
        return response()->json([
            'message'=>'Post has being updated successfully',
            'updated_post'=> $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
