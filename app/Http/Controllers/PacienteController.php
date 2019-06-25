<?php

namespace App\Http\Controllers;

use App\Contatos;
use App\Paciente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

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

        $date = Carbon::createFromFormat('d/m/Y', $pacienteRequest['nascimento']);
        $pacienteRequest['nascimento'] = $date;

        $validator = Validator::make($pacienteRequest,
            [
                'cpf' => 'required|formato_cpf|cpf',
                'rg' => 'required|numeric',
                'email' => 'email',
                'nascimento'=> 'date'
            ]
        );
        if ($validator->fails()) {
            return  redirect()->back()->withInput($request->all())->withErrors($validator->messages());

        }
        $contatosRequest = $request->only(['contatos']);

        $data_cadastro= \Carbon\Carbon::now();

        $paciente = new Paciente();
        $paciente->fill($pacienteRequest);
        $paciente->data_cadastro = $data_cadastro;

        $pacienteVerifica = Paciente::where('cpf',$paciente->cpf)->get();
        if ($pacienteVerifica->count() > 0) {
            return  redirect()->back()->withInput($request->all())->withErrors(['Já temos alguém com este CPF cadastrado']);
        }

        $paciente->codigo = uniqid();
        $paciente->save();
        $contatos = [];
        foreach($contatosRequest as $contato) {
                $contatoN = new Contatos();
                $contatoN->numero = $contato[0];
            array_push ($contatos, $contatoN);
        }
        $paciente->contatos()->saveMany($contatos);
        return Redirect::to('/pacientes/listar');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);
        return view("contents.pacientes_editar",compact('paciente'));
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
        $paciente = Paciente::find($id);
        if (!$paciente) {
            return  redirect()->back()->withInput($request->all())->withErrors('Paciente não encontrado');
        }

        $pacienteRequest = $request->except(['contatos','_token']);
        $date = Carbon::createFromFormat('d/m/Y', $pacienteRequest['nascimento']);
        $pacienteRequest['nascimento'] = $date;

        $validator = Validator::make($pacienteRequest,
            [
                'cpf' => 'required|formato_cpf|cpf',
                'rg' => 'required|numeric',
                'email' => 'email',
                'nascimento'=> 'date'
            ]
        );
        if ($validator->fails()) {
            return  redirect()->back()->withInput($request->all())->withErrors($validator->messages());

        }
        $contatosRequest = $request->only(['contatos']);

        $paciente->fill($pacienteRequest);
        $pacienteVerifica = Paciente::where('cpf',$request->cpf)->first();
        if ($pacienteVerifica->count() > 0 && $pacienteVerifica->id != $id) {
            return  redirect()->back()->withInput($request->all())->withErrors(['Já temos alguém com este CPF cadastrado']);
        }

        $paciente->update();

        $contatos = [];

        $paciente->contatos()->delete();

        foreach($contatosRequest as $contato) {
            $contatoN = new Contatos();
            $contatoN->numero = $contato[0];
            array_push ($contatos, $contatoN);
        }
        $paciente->contatos()->saveMany([$contatos]);

        return view("contents.pacientes_editar",compact('paciente'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pacienterec = Paciente::find($id);
        $pacienterec->contatos()->delete();
        $retorno = $pacienterec->delete();
        if ($retorno) {
            return response()->json('sucesso',200);
        } else {
            return response()->json('erro',400);
        }
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
