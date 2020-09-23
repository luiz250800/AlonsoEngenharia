<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'tb_cliente';
    protected $primaryKey = 'cd_cliente';

    protected $fillable = [
        'cd_cliente',
        'cd_usuario',
        'nm_razao_social_cliente',
        'nm_fantasia_cliente',
        'cd_cnpj_cliente',
        'nm_endereco_cliente',
        'nm_email_cliente',
        'cd_telefone_cliente',
        'nm_responsavel_cliente',
        'cd_cpf_responsavel_cliente',
        'cd_celular_responsavel_cliente'
    ];

    function Usuario(){
        return $this->belongsTo('App\Models\Usuario', 'cd_usuario', 'cd_usuario');
    }

    public function Proposta()
    {
        return $this->hasMany('App\Models\Proposta', 'cd_cliente', 'cd_cliente');
    }
}
