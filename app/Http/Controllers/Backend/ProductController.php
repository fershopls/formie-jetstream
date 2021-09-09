<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $categories = ['Videojuegos', 'Azar', 'Inmuebles', 'Vehiculos', 'Musica'];

        return inertia('Backend/Products/Create', [
            'title' => 'Crear un producto',
            'categories' => $categories,
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'images' => 'required|array',
            'images.*' => 'file|mimes:png,jpg,jpeg'
        ]);

        dd($request->all());
    }
}
