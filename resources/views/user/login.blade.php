@extends('layouts.template')

@section('cabecalho')
<div>
    Acessar
</div>
@endsection

@section('conteudo')
<form method="post">
    @csrf
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" name="password" id="password" required min="1" class="form-control">
    </div>
    <div class="form-row">
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mt-3"> Entrar</button>
        </div>
        <!-- <div class="col-auto mt-3 pl-3">
            <a class="btn btn-link" href="{{ route('password_request') }}">Esqueci minha senha</a>
        </div> -->
    </div>

</form>
@endsection
