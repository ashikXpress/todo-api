<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return Todo::orderBy('id','desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return TodoResource
     */
    public function store(Request $request)
    {
        $request->validate([
           'item_name'=>'required|max:50',
           'description'=>'nullable|max:255',
        ]);
        $todo = Todo::create([
            'item_name' => $request->item_name,
            'description' => $request->description,
        ]);

        return $todo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return Todo
     */
    public function show(Todo $todo)
    {
        return $todo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return bool
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'item_name'=>'required|max:50',
            'description'=>'nullable|max:255',
        ]);
        return $todo->update([
            'item_name'=>$request->item_name,
            'description'=>$request->description,
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Todo $todo)
    {

        $todo->delete();

        return response()->json(null, 204);
    }
}
