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
                $path = $file->store('products');
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
}
