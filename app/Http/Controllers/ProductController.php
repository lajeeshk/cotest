<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = file_get_contents(app_path('data/products.json'));
        $products = collect(json_decode($products));
        return view('product/index', ['products' =>$products]);
    }

    public function create(Request $request) {
        $newProduct = [];
        $newProduct['name'] = $request->get('name');
        $newProduct['price'] = $request->get('price');
        $newProduct['quantity'] = $request->get('quantity');
        $newProduct['total'] = $newProduct['price'] * $newProduct['quantity'];
        $newProduct['dateSubmitted'] = Carbon::now();

        $products = file_get_contents(app_path('data/products.json'));
        $products = collect(json_decode($products));

        $products->push($newProduct);
        file_put_contents(app_path('data/products.json'), $products->toJson());

        $newProduct['dateSubmitted'] = Carbon::parse($newProduct['dateSubmitted'])->format('d/m/Y H:i A');
        
        return json_encode($newProduct);
    }
}
