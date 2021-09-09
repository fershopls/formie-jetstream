<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return inertia('Backend/Products/Create', [
            'title' => 'Crear un producto',
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'images' => 'required|array',
        ]);

        dd($request->all());
    }
}
