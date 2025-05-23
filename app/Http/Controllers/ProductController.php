<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
{
    return Inertia::render('Catalog', [
        'products' => Product::all()->toArray() // Явное преобразование в массив
    ]);
}

public function show($id)
{
    $product = Product::findOrFail($id);
    
    // Преобразуем images в массив, если это JSON строка
    $product->images = is_string($product->images) 
        ? json_decode($product->images, true) 
        : ($product->images ?? []);
    
    // Если нет дополнительных изображений, используем основное
    if (empty($product->images) && $product->image) {
        $product->images = [$product->image];
    }
    
    return Inertia::render('Product', [
        'productData' => $product
    ]);
}
}

