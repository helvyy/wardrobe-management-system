<?php

namespace App\Http\Controllers;

use App\Models\ClothingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClothingItemController extends Controller {


    public function index(Request $request) {
        $query = ClothingItem::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        }
        return response()->json($query->get());
    }


    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'image' => 'nullable|string',
        ]);
        $data['user_id'] = Auth::id();
        $item = ClothingItem::create($data);
        return response()->json($item, 201);
    }


    public function show($id) {
        $item = ClothingItem::findOrFail($id);
        return response()->json($item);
    }


    public function update(Request $request, $id) {
        $item = ClothingItem::findOrFail($id);
        if ($item->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'sometimes|required|string',
            'image' => 'nullable|string',
        ]);
        $item->update($data);
        return response()->json($item);
    }

    
    public function destroy($id) {
        $item = ClothingItem::findOrFail($id);
        if ($item->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $item->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
