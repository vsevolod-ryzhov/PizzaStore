<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Product;
use App\Http\Requests\Admin\Products\CreateRequest;
use App\Http\Requests\Admin\Products\UpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id')->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(CreateRequest $request)
    {
        $product = Product::create([
            'title' => $request['title'],
            'price' => $request['price'],
            'image' => $request->file('image')->store('products', 'public'),
        ]);

        return redirect()->route('admin.products.show', $product);
    }

    public function show(Product $product)
    {
        $img = Storage::disk('public')->url($product->image);
        return view('admin.products.show', compact('product', 'img'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $product->update([
            'title' => $request['title'],
            'price' => $request['price'],
            'image' => $request->file('image')->store('products', 'public'),
        ]);

        return redirect()->route('admin.products.show', $product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
