<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = file_get_contents(app_path('data/products.json'));
        $products = collect(json_decode($products));
        return view('product/index', ['products' =>$products]);
    }
}
