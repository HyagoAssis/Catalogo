@extends('layouts.app')

@section('content') 

@slot('title', 'Cadastrar Produto')

<h1>{{ $product->name }} </h1>

    
@endsection