<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\CadastroUsuarioValidate;
use App\Http\Requests\LoginUsuarioValidate;

class UsuarioController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login.register.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastroUsuarioValidate $request)
    {
        $usuario  = new Usuario();
        $usuario->nm_usuario = $request->input("nmUsuario");
        $usuario->nm_email_usuario = $request->input("nmEmail");
        $usuario->nm_senha_usuario = $request->input("nmSenha");
        $usuario->save();

        return view('index.index', ["response" => "Usuario cadastrado com sucesso!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function find(LoginUsuarioValidate $request)
    {
        $usuario = Usuario::where('nm_email_usuario', '=', $request->input("nmEmail"))->where('nm_senha_usuario', '=', $request->input("nmSenha"))->get();
        if($usuario->count() > 0){
            session(['cd_usuario' => $usuario[0]->cd_usuario]);
            return redirect('/client/register');
        }else{
            return redirect('/')->with('response', 'Usuario não cadastrado!');
        }
    }

    public function logout()
    {
        session()->forget('cd_usuario');
        return redirect('/')->with('response', 'Deslogado!');
    }
}
