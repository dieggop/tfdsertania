<?php

namespace App\Http\Controllers;

use App\Liberacoes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RelatoriosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index() {
        return view('contents.relatorios');
    }
    public function gerar(Request $request) {
        $periodo = explode(" - ", $request->periodo);
        $periodoInicio = Carbon::createFromFormat('d/m/Y', $periodo[0]);
        $periodoFim = Carbon::createFromFormat('d/m/Y', $periodo[1]);

        $relatorio = Liberacoes::whereBetween('emissao',[$periodoInicio,$periodoFim])->with('paciente')->get();

        return view('contents.relatorios_print',compact('relatorio','periodo'));
    }
}
