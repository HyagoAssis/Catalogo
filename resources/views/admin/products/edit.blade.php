@extends('layouts.app')

@section('content') 

@slot('title', 'Cadastrar Produto')
@slot('url', route('produtos.update', 'produto'))

<form action="{{ $url ?? '/' }}" method="POST">
@csrf
@method('put')  

<div class="form-group col-sm-6">
        <label for="nome" class="required">Nome </label>
        <input type="text" name="name" id="nome">
    </div>

    
<button type="submit"> Cadastrar</button>
</form>

    
@endsection