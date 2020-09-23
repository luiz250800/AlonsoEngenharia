<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    use HasFactory;

    protected $table = 'tb_proposta';
    protected $primaryKey = 'cd_proposta';

    protected $fillable = [
        'cd_proposta',
        'cd_cliente',
        'nm_endereco_obra',
        'vl_total',
        'vl_sinal',
        'qt_parcela',
        'vl_parcela',
        'dt_inicio_pagamento',
        'dt_parcela',
        'nm_caminho_arquivo_proposta',
        'tp_status_proposta',
        'created_at'
    ];

    function Cliente(){
        return $this->belongsTo('App\Models\Cliente', 'cd_cliente', 'cd_cliente');
    }
}
