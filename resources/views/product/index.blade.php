@extends('layouts.app')

@section('content')
<h1>Welcome</h1>
<div class="row">

    <form method='post' action="create" id="create-product">
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
          <input type="number" class="form-control" id="quantity" name='quantity' step='1' required>
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
    <th>Action</th>
</thead>
@foreach ($products as $product) 
<tr>
    <td>{{ $product->name }}</td>
    <td>{{ $product->quantity }}</td>
    <td>{{ $product->price }}</td>
    <td>{{ $product->total }}</td>
    <td>{{ Carbon\Carbon::parse($product->dateSubmitted)->format('d/m/Y H:i A') }}</td>
    <td><a href="Javascript:void(0)" class="edit-product">Edit</a></td>
</tr>

@endforeach
<tr>
    <th>Total</th>
<th>{{ $total }}</th>
    <td colspan="4"></td>
</tr>
</table>
</div>

<div class="modal" tabindex="-1" role="dialog" id="update-product">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method='post' action="update" id="update-product">
                {!! csrf_field() !!}
                <input type="hidden" name="product_id">
                <div class="form-group">
                  <label>Product Name</label>
                  <input type="text" class="form-control" id="product-name" name='name1' required>
                </div>
                <div class="form-group">
                  <label >Price</label>
                  <input type="number" class="form-control" id="price" step="any" name='price1' required>
                </div>
                <div class="form-group">
                <label>Quantity</label>
                  <input type="number" class="form-control" id="quantity" name='quantity1' required>
                </div>

              
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection