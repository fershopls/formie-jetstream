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
}
