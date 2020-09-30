<?php

namespace App\Http\Controllers;

use Exception;
use App\Acompanhamento;
use App\Filme;
use App\Seriado;
use App\Enums\Status;
use App\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcompanhamentoController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $filmes = Acompanhamento::join('programas', 'programas.id', '=', 'programa_id')->where('user_id', Auth::id())->Where('type', 1)->get();
        foreach ($filmes as $value) {
            $value->situacao = Status::instanceFromKey($value->situacao)->value();
        }
        $seriados = Acompanhamento::join('programas', 'programas.id', '=', 'programa_id')->where('user_id', Auth::id())->Where('type', 2)->get();
        foreach ($seriados as $value) {
            $value->situacao = Status::instanceFromKey($value->situacao)->value();
        }
        return view('acompanhamento.lista', ['filmes' => $filmes, 'seriados' => $seriados]);
    }

    public function createFilme()
    {
        $status = Status::map();
        return view('acompanhamento.novo', ['tipo' => 'filme', 'status' => $status]);
    }

    public function createSeriado()
    {
        $status = Status::map();
        return view('acompanhamento.novo', ['tipo' => 'seriado', 'status' => $status]);
    }

    public function editarFilme()
    {
        $status = Status::map();
        return view('acompanhamento.editar', ['tipo' => 'filme', 'status' => $status]);
    }

    public function editarSeriado()
    {
        $status = Status::map();
        return view('acompanhamento.editar', ['tipo' => 'seriado', 'status' => $status]);
    }


    public function edit($id)
    {
        $status = Status::map();
        $acompanhamento = Acompanhamento::find($id);
        $programa = Programa::find($acompanhamento->programa_id);
        if ($programa->type == 1) {
            $tipo = "filme";
        } else {
            $tipo = "seriado";
        }
        return view('acompanhamento.editar', ['acompanhamento' => $acompanhamento, 'tipo' => $tipo, 'programa' => $programa, 'status' => $status]);
    }

    public function store(Request $request)
    {
        $tipo = $request->type;
        $data = $request->except("_token");
        try {
            DB::beginTransaction();
            if ($request->has('id')) {
                $acompanhamento = Acompanhamento::find($request->id);
                $programa = Programa::find($acompanhamento->programa_id);
            } else {
                if ($tipo == "filme") {
                    $programa = new Filme();
                } else {
                    $programa = new Seriado();
                }
            }
            $programa->nome = $data['nome'];
            $programa->nome_original = $data['nome_original'];
            $programa->ano = $data['ano'];
            $programa->save();
            if (!$request->has('id')) {
                $acompanhamento = new Acompanhamento();
            }
            $acompanhamento->provedor = $data['provedor'];
            $acompanhamento->user_id = Auth::id();
            $acompanhamento->programa_id = $programa->id;
            $acompanhamento->situacao = $data['situacao'];
            if ($tipo == "seriado") {
                $acompanhamento->episodio = $data['episodio'];
            }
            $acompanhamento->save();
            DB::commit();
            $request->session()
                ->flash(
                    'success',
                    Str::title("$tipo cadastrado com sucesso !!!")
                );
            return redirect()->route('lista');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
            ->withErrors('Erro ao salvar os dados!!!');
        }
    }

    public function destroy($id)
    {
        $pedido = Acompanhamento::find($id);
        $pedido->delete();
        return redirect()->route('lista');
    }
}
