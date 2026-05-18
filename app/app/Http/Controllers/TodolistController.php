<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    public function index()
    {
        return Todolist::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $todolist = Todolist::create($validated);
        return response()->json($todolist, 201);
    }

    public function show(Todolist $todolist)
    {
        return $todolist->load(['items']);
    }

    public function update(Request $request, Todolist $todolist)
    {
        $validated = $request->validate([
            'name'        => ['sometimes', 'required', 'string'],
            'description' => ['nullable', 'string'],
        ]);

        $todolist->update($validated);
        return response()->json($todolist);
    }

    public function destroy(Todolist $todolist)
    {
        $todolist->delete();
        return response()->json(null, 204);
    }

    public function items(Todolist $todolist)
    {
        return $todolist->items;
    }
}