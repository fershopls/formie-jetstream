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
}
