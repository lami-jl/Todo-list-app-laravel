<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return Item::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'stato'   => ['required', 'string'],
            'list_id' => ['required', 'exists:todolists,id'],
        ]);

        $item = Item::create($validated);
        return response()->json($item, 201);
    }

    public function show(Item $item)
    {
        return $item->load('todolist');
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name'    => ['sometimes', 'required', 'string', 'max:255'],
            'stato'   => ['sometimes', 'required', 'string'],
            'list_id' => ['sometimes', 'required', 'exists:todolists,id'],
        ]);

        $item->update($validated);
        return response()->json($item);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response(null, 204);
    }
}