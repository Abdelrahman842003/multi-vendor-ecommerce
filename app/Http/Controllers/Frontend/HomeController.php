<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Interface\Frontend\HomeInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private HomeInterface $homeInterface ){}
    public function index()
    {
        return $this->homeInterface->index();
    }
    public function show(Product $product)
    {
        return $this->homeInterface->show($product);
    }
}
