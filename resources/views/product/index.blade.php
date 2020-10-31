@extends('layouts.app')

@section('content')
<h1>Welcome</h1>
<div class="row">

    <form method='post' action="create" id="cretae-product">
        {!! csrf_field() !!}
        <div class="form-group">
          <label>Product Name</label>
          <input type="text" class="form-control" id="product-name" name='name' required>
        </div>
        <div class="form-group">
          <label >Price</label>
          <input type="number" class="form-control" id="price" step="any" name='price' required>
        </div>
        <div class="form-group">
        <label>Quantity</label>
          <input type="number" class="form-control" id="quantity" name='quantity' required>
        </div>
        <button type="submit" class="btn btn-primary" id="submit-product">Submit</button>
      </form>
</div>
<div class="row">
<table class="table mt-5" id="product-list">
<thead>
    <th>Product name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Total</th>
    <th>Datetime Submitted</th>
</thead>
@foreach ($products as $product) 
<tr>
    <td>{{ $product->name }}</td>
    <td>{{ $product->quantity }}</td>
    <td>{{ $product->price }}</td>
    <td>{{ $product->total }}</td>
    <td>{{ Carbon\Carbon::parse($product->dateSubmitted)->format('d/m/Y H:i A') }}</td>
</tr>

@endforeach
</table>
</div>
@endsection