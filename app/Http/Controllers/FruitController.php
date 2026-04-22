<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    // Get all fruits
    public function index()
    {
        $fruits = Fruit::pluck('name')->toArray();
        return response()->json($fruits);
    }

    // Store new fruit
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:fruits,name',
        ]);

        Fruit::create($validated);

        return response()->json(['message' => 'تم إضافة الصنف بنجاح']);
    }

    // Delete fruit
    public function destroy($name)
    {
        Fruit::where('name', $name)->delete();
        return response()->json(['message' => 'تم حذف الصنف']);
    }
}
