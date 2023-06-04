<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request){
       
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'nullable|integer|min:1|max:3',
            'done' => 'boolean',
        ]);
        $todo = Todo::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Todo created.',
            'data' => $todo,
        ],201);
    }

    public function index(Request $request){
        $todos = Todo::all();

        return response()->json([
            'status' => true,
            'message' => 'Todos.',
            'data' => $todos,
        ],201);
    }

    public function show(Request $request, $id){
        $todo = Todo::find($id);

        return response()->json([
            'status' => true,
            'message' => '1 todo.',
            'data' => $todo,
        ],201);
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'priority' => 'nullable|integer|min:1|max:3',
            'done' => 'boolean',
        ]);

        $todo = Todo::find($id);
        if($todo){
            $todo->update($data);
            $todos = Todo::all();
            return response()->json([
                'status' => true,
                'message' => 'Todo updated.',
                'data' => $todos,
            ],200);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => 'Unsuccessful',
                'data' => null,
            ],404);
        }
    }

    public function delete(Request $request, $id){

        $todo = Todo::find($id);
        if($todo){
            $todo->delete();

            return response()->json([
                'status' => true,
                'message' => 'Todo deleted.',
                'data' => null,
            ],200);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => 'Unsuccessful',
                'data' => null,
            ],404);
        }
    }
}
