@extends('layouts.template')

@section('cabecalho')
<div>
    Cadastro de {{Str::title($tipo)}}
</div>
@endsection

@section('conteudo')
<form method="post" action="/acompanhamento">
    @csrf
    <div class="form-row">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>

    <div class="form-row">
        <label for="nome_original">Nome Original</label>
        <input type="text" class="form-control" name="nome_original" id="nome_original">
    </div>

    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="ano">Ano de lançamento</label>
            <input type="text" class="form-control" id="ano" name="ano" maxlength="4">
        </div>

        <div class="form-group col-md-6">
            <label for="provedor">Onde Assistir</label>
            <input type="text" class="form-control" id="provedor" name="provedor">
        </div>

        <div class="form-group col-md-3">
            <label for="situacao">Situação</label>
            <select class="custom-select" id="situacao" name="situacao">
                @foreach($status as $key=>$situacao)
                <option value="{{$key}}">{{$situacao}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <input type="hidden" name="type" value="{{$tipo}}">

    @if ($tipo == 'seriado')
    <div class="form-inline">
        <label for=" episodio">Informe o último episódio assistido</label>
        <input type="text" class="form-control col-md-1 ml-4" id="episodio" name="episodio" placeholder="Ex. S01E12" maxlength="10">
    </div>
    @endif
    <hr>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{route('lista')}}" alt="Cancelar" data-toggle="tooltip" title="Cancelar" class="btn btn-secondary">Cancelar</a>

</form>
@endsection
