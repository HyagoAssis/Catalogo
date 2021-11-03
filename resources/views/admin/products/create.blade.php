@extends('layouts.app')

@section('content') 

@slot('title', 'Cadastrar Produto')


<form action="/produtos" method="POST">
@csrf  

<div class="form-group col-sm-6">
        <label for="nome" class="required">Nome </label>
        <input type="text" name="name" id="nome">
    </div>

    
<button type="submit"> Cadastrar</button>
</form>

    
@endsection