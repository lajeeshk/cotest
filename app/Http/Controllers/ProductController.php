<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = file_get_contents(app_path('data/products.json'));
        $products = collect(json_decode($products));
        $total = $products->sum('total');
        return view('product/index', ['products' =>$products, 'total' => $total]);
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
        $total = $products->sum('total');
        $data['product'] = $newProduct;
        $data['total'] = $total;
        
        return json_encode($data);
    }

    public function update(Request $request, $productId) {

        $products = file_get_contents(app_path('data/products.json'));
        $products = collect(json_decode($products));

        $product = $products[$productId];

        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->quantity = $request->get('quantity');

        $product->total = $product->price * $product->quantity;

        $products[$productId] = $product;

        file_put_contents(app_path('data/products.json'), $products->toJson());

        $total = $products->sum('total');
        $data['product'] = $product;
        $data['total'] = $total;

        return json_encode($data);

    }
}
