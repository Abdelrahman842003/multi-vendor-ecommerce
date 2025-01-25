<?php

namespace App\Http\Repository\Frontend;


use App\Http\Interface\Frontend\HomeInterface;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Product;

class HomeRepository implements HomeInterface
{
    use AttachFilesTrait;


    public function index()
    {
        $productActive = Product::with('category')->active()->get();
        return view('frontend.master', compact('productActive'));
    }

    public function show($product)
    {
        $product = Product::with('category')->findOrFail($product);
    if (!$product){
         abort(404);
    }
        return view('frontend.singleProduct', compact('product'));
    }
}
