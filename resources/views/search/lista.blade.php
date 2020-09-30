@extends('layouts.template')

@section('cabecalho')
<div>
    Resultado da pesquisa
</div>
@endsection

@section('conteudo')
<ul class="list-group">
    @forelse ($programas as $programa)
    <li class="list-group-item">
        {{Str::title($programa->nome)}}
        @if ($programa->type == 1)
        (Filme)
        @else
        (Seriado)
        @endif
    </li>
    @empty
    <p>Nenhum filme/seriado localizado!!!</p>
    @endforelse
</ul>

@endsection
