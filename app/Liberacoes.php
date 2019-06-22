<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liberacoes extends Model
{
    protected $table = 'autorizacao';
    protected $fillable = [
        'id',
        'emissao',
        'valor',
        'pessoa_id',
        'nome_pessoa',
        'discriminacao'
    ];
    public function paciente() {
       return $this->belongsTo(Paciente::class);
    }
}
