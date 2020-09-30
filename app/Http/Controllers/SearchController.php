<?php

namespace App\Http\Controllers;

use App\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function index(Request $request) {

        $search = basename($request->url());
        if (Str::length($search) < 3) {
            return view('search.lista', ['programas' => []])->withErrors('É necessário informar ao menos 3 caracteres para realizar a pesquisa.');;
        }
        $programas = Programa::distinct()->where('nome', 'like', '%' . $search . '%')->orWhere('nome_original', 'like', '%' . $search . '%')->get();
        return view('search.lista', ['programas' => $programas]);
    }

    public function search(Request $request)
    {
        $data = rawurlencode($request->search);
        return redirect()->route('pesquisa_get', $data);
    }
}
