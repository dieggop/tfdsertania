<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pessoas';
    protected $fillable = [
        'id',
        'nome',
        'data_cadastro',
        'endereco',
        'cidade',
        'cpf',
        'rg',
        'fone',
        'estado_civil',
        'nascimento',
        'sexo',
        'codigo'
    ];
    protected $dates = ['data_cadastro','nascimento'];
    public function liberacoes() {
        return $this->hasMany(Liberacoes::class,'pessoa_id', 'id');
    }
    public function contatos() {
        return $this->hasMany(Contatos::class,'pessoas_id');
    }
}
