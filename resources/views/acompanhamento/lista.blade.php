@extends('layouts.template')

@section('cabecalho')
<div>
    Minha Lista de Acompanhamento
</div>
@endsection

@section('conteudo')

@if ((count($filmes)==0) && (count($seriados)==0))
<p>nenhum dados cadastrado!!!</p>
@endif

@if (count($filmes)>0)
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Meus Filmes</th>
            <th style="width:150px">Situação</th>
            <th style="width:60px"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($filmes as $filme)
        <tr>
            <td>{{Str::title($filme->programa->nome)}}</td>
            <td>{{$filme->situacao}}</td>
            <td>
                <a href="/acompanhamento/{{$filme->programa->id}}" alt="Editar Filme" data-toggle="tooltip" title="Editar Filme"><i class="fas fa-edit"></i></a>
                <a href="/acompanhamento/{{$filme->programa->id}}/remove" alt="Excluir Filme" data-toggle="tooltip" title="Excluir Filme"><i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<br><br>
@endif

@if (count($seriados)>0)
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Meus Seriados</th>
            <th class="text-center" style="width:200px">Episódio</th>
            <th style="width:150px">Situação</th>
            <th style="width:60px"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($seriados as $seriado)
        <tr>
            <td scope="row">{{Str::title($seriado->nome)}}</td>
            <td class="text-center">{{$seriado->episodio ?? '---'}}</td>
            <td>{{$seriado->situacao}}</td>
            <td>
                <a href="/acompanhamento/{{$seriado->id}}" alt="Editar Seriado" data-toggle="tooltip" title="Editar Seriado"><i class="fas fa-edit"></i></a>
                <a href="/acompanhamento/{{$seriado->id}}/remove" alt="Excluir Seriado" data-toggle="tooltip" title="Excluir Seriado"><i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<hr>
<a href="{{ route('filme') }}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Adicionar Filme</a>
<a href="{{ route('seriado') }}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Adicionar Seriado</a>
@endsection
