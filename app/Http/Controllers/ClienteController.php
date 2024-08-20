<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function buscarPorDni($dni)
    {
        $cliente = Cliente::where('dni', $dni)->first();

        if ($cliente) {
            return response()->json(['exists' => true, 'cliente' => $cliente]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
}