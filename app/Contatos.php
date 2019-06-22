<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contatos extends Model
{
protected $fillable = [
    'id', 'numero', 'pessoas_id'
];
    public function paciente() {
        return $this->belongsTo(Paciente::class, 'pessoas_id');
    }
}
