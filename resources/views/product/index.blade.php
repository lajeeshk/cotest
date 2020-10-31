@extends('layouts.app')

@section('content')
<h1>Welcome</h1>
<table class="table">
<thead>
    <th>Product name</th>
    <th>Quantity</th>
    <th>Price</th>
</thead>
@foreach ($products as $product) 
<tr>
    <td>{{ $product->name }}</td>
    <td>{{ $product->quantity }}</td>
    <td>{{ $product->price }}</td>
</tr>

@endforeach
</table>
@endsection