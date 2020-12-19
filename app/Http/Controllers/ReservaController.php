<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use DateTime;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reserva::all();
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
     * Recebe um horário de início e um id de usuário, calcula o horário de fim e salva uma reserva com os dados obtidos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reservaRequest = $request->all();
        $reserva = new Reserva();
        $reserva->inicio = $reservaRequest['inicio'];

        $hour = date('H', strtotime('+0 hour', strtotime($reserva->inicio)));
        $hourInt = intval($hour);
        if($hourInt < 6 || $hourInt > 21) return response("A quadra não está aberta neste horário", 400);
        if($hourInt % 2 != 0) return response("Horário quebrado", 400);
        if(strtotime($reserva->inicio) < time()) return response("Horário passado", 400);

        $reserva->fim = date('Y-m-d H:i:s', strtotime('+2 hour', strtotime($reserva->inicio)));
        $reserva->usuario_id = $reservaRequest['usuario_id'];

        $reservaExiste = Reserva::where('inicio', $reserva->inicio)->first();
        if($reservaExiste) return response("Horário já reservado", 400);

        $reserva->save();
        return response("Horário reservado com sucesso", 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Exclui do banco de dados a reserva que contém o horário de início passado como parâmetro.
     *
     * @param  dateTime  $inicio
     * @return \Illuminate\Http\Response
     */
    public function destroy($inicio)
    {
        DB::table('reservas')->where('inicio', $inicio)->delete();
        return response("Horário liberado para outros usuários", 201);
    }

    /**
     * Recebe uma data e lista os horários reservados na data.
     *
     * @param date $data
     * @return \Illuminate\Http\Response
     */
    public function listarPorData($data)
    {
        return DB::table('reservas')
            ->join('usuarios', 'usuarios.id', '=', 'reservas.usuario_id')
            ->select('reservas.inicio', 'reservas.fim', 'usuarios.nome as usuario')
            ->where('reservas.inicio', 'like', $data + '%')
            ->orderBy('reservas.inicio')
            ->get();
    }

    /**
     * Recebe um horário de início e um id de usuário e retorna a lista de horários reservados pelo usuário depois da data 
     * recebida.
     *
     * @param  int $usuario
     * @param  datetime $inicio
     * @return \Illuminate\Http\Response
     */
    public function listarPorUsuario($usuario, $inicio)
    {
        return DB::table('reservas')
            ->select('inicio', 'fim')
            ->where('usuario_id', '=', $usuario)
            ->where('inicio', '>', $inicio)
            ->orderBy('inicio')
            ->get();
    }
}
