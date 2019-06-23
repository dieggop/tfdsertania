<?php

namespace App\Http\Controllers;

use App\Liberacoes;
use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Money\Money;

class LiberacoesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $paciente= Paciente::find($id);
        $valorTotal = Liberacoes::where('pessoa_id','=',$id)->sum('valor');
        $liberacoes = Liberacoes::where('pessoa_id', $id)->orderBy('emissao', 'DESC')->paginate(20);
        return view('contents.liberacoes',compact('liberacoes','paciente','valorTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $paciente= Paciente::find($id);
        $emissao= \Carbon\Carbon::now();

        $valor =  str_replace (',', '.', str_replace ('.', '', $request->valor));

        $liberacao = new Liberacoes();
        $liberacao->fill($request->all());
        $liberacao->emissao = $emissao;
        $liberacao->pessoa_id = $paciente->id;
        $liberacao->valor = number_format($valor, 2, '.', '');

        $paciente->liberacoes()->save($liberacao);

        return Redirect::route('liberacoes.index', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$idliberacao)
    {
        $paciente= Paciente::find($id);
        $liberacao = Liberacoes::find($idliberacao);
        dd($liberacao);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
