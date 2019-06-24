<?php

namespace App\Http\Controllers;

use App\Liberacoes;
use App\Paciente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Money\Money;
use Jenssegers\Date\Date;

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
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');


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
        if ($request->has('id') && $request->id) {
            $liberacaoRec = Liberacoes::find($request->id);
            $liberacaoRec->fill($request->all());
            $liberacaoRec->valor = number_format($valor, 2, '.', '');
            $liberacaoRec->update();
        } else {
            $liberacao = new Liberacoes();
            $liberacao->fill($request->all());
            $liberacao->emissao = $emissao;
            $liberacao->pessoa_id = $paciente->id;
            $liberacao->codigo = uniqid();
            $liberacao->valor = number_format($valor, 2, '.', '');
            $paciente->liberacoes()->save($liberacao);
        }

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
        return response()->json($liberacao);
    }
    public function autorizacao($id,$idliberacao)
    {
        $paciente= Paciente::find($id);
        $liberacao = Liberacoes::find($idliberacao);
        Date::setLocale('pt-BR');
        $extenso = $this->extenso($liberacao->valor);
        return view('recibos.autorizacao', compact('paciente','liberacao','extenso'));
    }
    public function guiafatura($id,$idliberacao)
    {
        $paciente= Paciente::find($id);
        $liberacao = Liberacoes::find($idliberacao);
        return view('recibos.guia_fatura', compact('paciente','liberacao'));
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
    public function destroy($id,$idliberacao)
    {
        $liberacaoRec = Liberacoes::find($idliberacao);
        $retorno = $liberacaoRec->delete();
        if ($retorno) {
            return response()->json('sucesso',200);
        } else {
            return response()->json('erro',400);
        }
    }

    public function codigoliberacao(){
        $afetados = Liberacoes::all();
//        foreach ($afetados as $afetado) {
//            $afetado->codigo = uniqid();
//            $afetado->update();
//        }
        dd($afetados);
    }

    function extenso($valor = 0, $maiusculas = false) {
        if(!$maiusculas){
            $singular = ["centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão"];
            $plural = ["centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões"];
            $u = ["", "um", "dois", "três", "quatro", "cinco", "seis",  "sete", "oito", "nove"];
        }else{
            $singular = ["CENTAVO", "REAL", "MIL", "MILHÃO", "BILHÃO", "TRILHÃO", "QUADRILHÃO"];
            $plural = ["CENTAVOS", "REAIS", "MIL", "MILHÕES", "BILHÕES", "TRILHÕES", "QUADRILHÕES"];
            $u = ["", "um", "dois", "TRÊS", "quatro", "cinco", "seis",  "sete", "oito", "nove"];
        }

        $c = ["", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"];
        $d = ["", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"];
        $d10 = ["dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove"];

        $z = 0;
        $rt = "";

        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for($i=0;$i<count($inteiro);$i++)
            for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
                $inteiro[$i] = "0".$inteiro[$i];

        $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
        for ($i=0;$i<count($inteiro);$i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
                    $ru) ? " e " : "").$ru;
            $t = count($inteiro)-1-$i;
            $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($valor == "000")$z++; elseif ($z > 0) $z--;
            if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
            if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if(!$maiusculas){
            $return = $rt ? $rt : "zero";
        } else {
            if ($rt) $rt = ereg_replace(" E "," e ",ucwords($rt));
            $return = ($rt) ? ($rt) : "Zero" ;
        }

            return strtoupper($return);
    }
}
