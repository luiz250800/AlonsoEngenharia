<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'tb_usuario';
    protected $primaryKey = 'cd_usuario';

    protected $fillable = [
        'cd_usuario',
        'nm_usuario',
        'nm_email_usuario',
        'nm_senha_usuario'
    ];

    public function Cliente()
    {
        return $this->hasMany('App\Models\Cliente', 'cd_usuario', 'cd_usuario');
    }
}
