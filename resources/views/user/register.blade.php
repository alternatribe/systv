@extends('layouts.template')

@section('cabecalho')
<div>
    Cadastrar novo usuário
</div>
@endsection

@section('conteudo')
<form method="post">
    @csrf
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" required class="form-control">
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" name="password" id="password" required min="4" minlength="4" class="form-control">
    </div>
    <div class="form-group">
        <input type="hidden" name="password_confirmation" id="password_confirmation">
    </div>

    <button type="submit" class="btn btn-primary mt-3">
        Cadastrar
    </button>
</form>
@endsection
