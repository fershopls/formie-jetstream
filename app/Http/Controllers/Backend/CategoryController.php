<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function create()
    {
        return inertia('Backend/Form', [
            'form' => 'categories.js',
            'model' => null,
            'title' => 'Crear categoria',
        ]);
    }

    public function edit(Category $category)
    {
        return inertia('Backend/Form', [
            'form' => 'categories.js',
            'model' => $category,
            'title' => 'Editar categoria',
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'active' => 'required|boolean'
        ]);

        $category = Category::create($validated);

        return redirect()->route('categories.edit', $category->id);
    }


    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required',
            'active' => 'required|boolean'
        ]);

        $category->update($validated);

        return redirect()->route('categories.edit', $category->id);
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
