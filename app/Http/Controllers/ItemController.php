<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    // Display a listing of the items.
    public function index(Request $request)
    {
        $items = Item::paginate(10); // Adjust pagination as necessary
        return view('items.index', ['items' => $items]);
    }

    // Store a newly created item in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    // Show the form for editing the specified item.
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    // Update the specified item in storage.
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    // Remove the specified item from storage.
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

    // Search for items based on query.
    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = Item::where('name', 'LIKE', "%{$query}%")->paginate(10);
        return view('items.index', compact('items'));
    }
}

