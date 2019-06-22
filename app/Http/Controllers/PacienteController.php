<?php

namespace App\Http\Controllers;

use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class PacienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['atualizaRegistros']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pacientes = null;
        $dataForm = null;
        if ($request->has('busca')) {
            $dataForm = $request->except('_token');
            if ($request->filtro === 'cpf') {
                $pacientes = Paciente::where('cpf', $request->busca)->orderBy('id', 'DESC')->paginate(20);

            } else if ($request->filtro === 'nome') {
                $pacientes = Paciente::where('nome', 'like', '%'.$request->busca.'%')->orderBy('id', 'DESC')->paginate(20);
            } else {
                $pacientes = Paciente::where('codigo', $request->busca)->orderBy('id', 'DESC')->paginate(20);
            }
        } else {
            $pacientes = Paciente::with('contatos','liberacoes')->orderBy('id', 'DESC')->paginate(20);
        }
        return view("contents.pacientes", compact('pacientes','dataForm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("contents.pacientes_cadastro");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pacienteRequest = $request->except(['contatos','_token']);
        $validator = Validator::make($pacienteRequest,
            [
                'cpf' => 'required|formato_cpf|cpf',
                'rg' => 'required|numeric',
                'email' => 'email',
                'data_nascimento'=> 'date'
            ]
        );
        if ($validator->fails()) {
            return  Redirect::back()->withInput(Request::all())->withErrors($validator);
        }
        $contatosRequest = $request->only(['contatos']);

        $data_cadastro= \Carbon\Carbon::now();

        $paciente = new Paciente();
        $paciente->fill($pacienteRequest);
        $paciente->data_cadastro = $data_cadastro;

        $pacienteVerifica = Paciente::where('cpf',$paciente->cpf);
        if (!$pacienteVerifica) {

        }

        $paciente->save();
        dd($paciente);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function atualizaRegistros() {

        $afetados = Paciente::all();
//        foreach ($afetados as $afetado) {
//            $afetado->codigo = uniqid();
//            $afetado->update();
//        }
        dd($afetados);
    }
}
