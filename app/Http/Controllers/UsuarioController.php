<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Usuario::all();
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
     * Recebe as informações do usuário, verifica se o CPF ou o e-mail já está cadastrado, se a senha e a senha de confirmação são 
     * idênticas e, passando por todas as validações, cadastra um usuário no sistema.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuarioRequest = $request->all();
        $usuario = new Usuario();
        $usuario->nome = $usuarioRequest['nome'];
        $usuario->cpf = $usuarioRequest['cpf'];
        $usuario->telefone = $usuarioRequest['telefone'];
        $usuario->email = $usuarioRequest['email'];
        $usuario->senha = $usuarioRequest['senha'];
        $senhaConfirmacao = $usuarioRequest['senhaConfirmacao'];

        $usuarioExiste = Usuario::where('cpf', $usuarioRequest['cpf'])->first();
        if($usuarioExiste) return response("CPF já cadastrado", 400);

        $usuarioExiste = Usuario::where('email', $usuarioRequest['email'])->first();
        if($usuarioExiste) return response("Email já cadastrado", 400);

        if($usuario->senha != $senhaConfirmacao) return response("A senha não corresponde à senha de confirmação", 400);

        $usuario->senha = Hash::make($usuario->senha);
        $usuario->save();
        return response("Usuário cadastrado com sucesso", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Usuario::findOrFail($id);
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
    public function destroy($id)
    {
        //
    }

    /**
     * Recebe e-mail e senha do usuário, verifica se estão preenchidos, se estão cadastrados para o mesmo usuário no banco de 
     * dados e retorna os dados do usuário.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function logar(Request $request)
    {
        $usuarioRequest = $request->all();
        $email = $usuarioRequest['email'];
        $senha = $usuarioRequest['senha'];

        if(!$email || !$senha) return response("Credenciais inválidas", 400);

        $usuario = Usuario::where('email', $usuarioRequest['email'])->first();
        if(!$usuario) return response("Credenciais inválidas", 400);

        if(!Hash::check($senha, $usuario->senha)) return response("Credenciais inválidas", 400);

        return $usuario;
    }

}
