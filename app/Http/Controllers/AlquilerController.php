<?php

namespace App\Http\Controllers;

use App\Models\CabeceraAlquiler;
use App\Models\Cliente;
use App\Models\DetalleCabecera;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
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
        DB::transaction(function () use ($request) {
            // Crear registro en cabecera_alquileres

            $cliente = Cliente::where('dni', $request->dni)->first();

            $cabeceraAlquiler = CabeceraAlquiler::create([
                'id_cliente' => $cliente->id,
                'fecha_venta' => $request->fecha_venta,
                'total' => $request->total,
            ]);

            // Decodificar los videos desde el JSON
            $videos = json_decode($request->videos, true);

            // Crear registros en detalle_cabeceras
            foreach ($videos as $video) {
                DetalleCabecera::create([
                    'id_alquiler' => $cabeceraAlquiler->id,
                    'id_video' => $video['id_video'],
                    'precio' => $video['precio'],
                    'cantidad' => $video['cantidad'],
                ]);

                // Restar la cantidad del stock de cada video
                $videoModel = Video::find($video['id_video']);
                $videoModel->stock -= $video['cantidad'];
                $videoModel->save();
            }

            return view('alquileres.index', compact('alquileres'));
        });
    }

}
