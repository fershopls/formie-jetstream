<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        return Product::query()
            ->with('images')
            ->get();
    }


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
            'title' => 'Editar un producto',
            'categories' => $categories,
            'model' => $product,
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'images_upload' => 'required|array',
            'images_upload.*' => 'file|mimes:png,jpg,jpeg',
            'category_id' => 'required|integer',
        ]);

        $storedImages = collect($request->images_upload)
            ->map(function ($file) {
                $path = $file->store('public/products');
                return [
                    'path' => $path,
                    'url' => Storage::url($path),
                ];
            });

        $product = Product::create($validated);

        $product->images()->createMany(
            $storedImages->toArray()
        );

        return redirect()->route('products.edit', $product->id);
    }


    public function update(Product $product, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'images_upload' => 'nullable|array',
            'images_upload.*' => 'file|mimes:png,jpg,jpeg',
            'category_id' => 'required|integer',
        ]);

        $storedImages = collect($request->images_upload)
            ->map(function ($file) {
                $path = $file->store('public/products');
                return [
                    'path' => $path,
                    'url' => Storage::url($path),
                ];
            });

        $product->update($validated);

        $product->images()->createMany(
            $storedImages->toArray()
        );

        return redirect()->route('products.edit', $product->id);
    }


    public function destroy(Product $product)
    {
        $product->images->each(function ($image) {
            Storage::delete($image->path);
            $image->delete();
        });

        return $product->delete();
    }


    public function imagesDestroy(Product $product, Image $image)
    {
        if ($product->images()->detach($image->id)) {
            Storage::delete($image->path);
            $image->delete();
        }

        return redirect()->route('products.edit', $product->id);
    }
}
