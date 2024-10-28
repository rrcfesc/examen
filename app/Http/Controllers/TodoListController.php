<?php

namespace App\Http\Controllers;

use App\DataTables\TodoListDataTable;
use App\Models\TodoList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TodoListController extends Controller
{
    public function index(TodoListDataTable $dataTable)
    {
            return $dataTable->render('dashboard');
    }

    public function getData()
    {
        $user = auth()->user();
        $todoList = TodoList::select(['id', 'title', 'description', 'completed','created_at'])->where('user_id', $user->id);

        return DataTables::of($todoList)
            ->addColumn('action', function ($todoList) {
                return '<a href="' . route('todo.edit', $todoList) . '" class="text-blue-600 hover:underline">Edit</a> &nbsp;<a onclick="deleteTodo(this)" data-id="' . $todoList->id . '" href="#" class="text-blue-600 hover:underline">Borrar</a>';
            })->addColumn('created', function ($todoList) {
                $createdAt = Carbon::parse($todoList->created_at);
                return $createdAt->diffForHumans();
            })
            ->rawColumns(['action'])
            ->make(true);
    }



    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'completed' => 'boolean',
        ]);

        $requestData = array_merge($request->all(), ['user_id' => $user->id]);
        unset($requestData['_token']);

        TodoList::create($requestData);

        return redirect()->route('dashboard')->with('success', 'todo created successfully.');
    }


    public function edit($id)
    {
        $todoList = TodoList::findOrFail($id);
        return view('todo.edit', compact('todoList'));
    }

    public function update(Request $request, $id)
    {
        $todoList = TodoList::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',

        ]);
        $updated = $todoList->update($request->all());

        return redirect()->route('dashboard')->with('success', 'todo updated successfully.');

    }

    public function destroy($id)
    {
        $todoList = TodoList::findOrFail($id);
        $todoList->delete();

        return response()->json(['message' => 'Operación exitosa']);
    }

    public function show(TodoList $todoList)
    {
        return redirect()->route('dashboard');
    }
}
