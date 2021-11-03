@extends('layouts.app')

@section('content') 

@foreach ($products as $product)    
    <a href="{{ route('produtos.show', $product->id) }}"> {{ $product->name }} </a>
@endforeach
<a href="{{ route('produtos.show', $product->id) }}"> teste </a>
    
@endsection