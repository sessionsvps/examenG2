<?php

namespace App\Http\Controllers;

use App\Models\CabeceraAlquiler;
use App\Models\Video;
use Illuminate\Http\Request;

class AlquilerController extends Controller
{

    public function index()
    {
        $alquileres = CabeceraAlquiler::all();
        return view('alquileres.index', compact('alquileres'));
    }

    public function create()
    {
        $ultimoAlquiler = CabeceraAlquiler::latest('id')->first();
        $nroFicha = $ultimoAlquiler ? $ultimoAlquiler->id + 1 : 1;
        $videos = Video::all();
        return view('alquileres.create', compact('videos', 'nroFicha'));
    }

    public function store(Request $request)
    {
        //
    }

}
