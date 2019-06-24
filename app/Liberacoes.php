<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liberacoes extends Model
{
    protected $table = 'autorizacao';
    protected $fillable = [
        'id',
        'codigo',
        'emissao',
        'valor',
        'pessoa_id',
        'nome_pessoa',
        'discriminacao'
    ];
    protected $dates = ['emissao'];

    public function paciente() {
       return $this->belongsTo(Paciente::class);
    }
}
