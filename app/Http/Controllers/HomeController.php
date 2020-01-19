<?php

namespace App\Http\Controllers;

use App\Entity\Product;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id')->paginate(20);
        return view('home', compact('products'));
    }

    public function product($id)
    {
        $product = Product::find($id);
        $img = Storage::disk('public')->url($product->image);
        return view('product', compact('product', 'img'));
    }
}
