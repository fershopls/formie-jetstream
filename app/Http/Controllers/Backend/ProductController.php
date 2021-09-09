<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function edit(Product $product)
    {
        $product->load('images');

        $categories = ['Videojuegos', 'Azar', 'Inmuebles', 'Vehiculos', 'Musica'];

        return inertia('Backend/Products/Create', [
            'title' => 'Crear un producto',
            'categories' => $categories,
            'model' => $product,
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'images' => 'required|array',
            'images.*' => 'file|mimes:png,jpg,jpeg',
            'category_id' => 'required|integer',
        ]);

        $storedUrls = collect($request->images)
            ->map(function ($file) {
                $path = $file->store('public/products');
                return Storage::url($path);
            });

        $product = Product::create($validated);

        $records = $storedUrls->map(function ($url) {
            return ['url' => $url];
        });

        $product->images()->createMany(
            $records->toArray()
        );

        return $product;
    }


    public function imagesDestroy($id)
    {
        return $id;
    }
}
