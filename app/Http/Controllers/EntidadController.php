<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entidad;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entidades = Entidad::all();
        return response()->json($entidades, Response::HTTP_OK)
                        ->header('Access-Control-Allow-Origin', '*');
    }
    public function create()
    {
        //
        return view('entidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:191',
            'nit' => 'required|string|max:191',
            'direccion' => 'nullable|string|max:191',
            'telefono' => 'nullable|string|max:191',
            'email' => 'nullable|email|max:191',
        ]);

        $entidad = Entidad::create($validatedData);
        return response()->json($entidad, Response::HTTP_CREATED);
        
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        $entidad = Entidad::find($id);

        if (!$entidad) {
            return response()->json(['error' => 'Entidad no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($entidad, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     */

     public function edit(Entidad $entidad)
     {
         //
         return view('entidad.edit', compact('entidad'));
     }
    public function update(Request $request, $id)
    {
        $entidad = Entidad::find($id);

        if (!$entidad) {
            return response()->json(['error' => 'Entidad no encontrada'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $entidad->update($validatedData);
        return response()->json($entidad, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entidad = Entidad::find($id);

        if (!$entidad) {
            return response()->json(['error' => 'Entidad no encontrada'], Response::HTTP_NOT_FOUND);
        }

        $entidad->delete();
        return response()->json(['message' => 'Entidad eliminada correctamente'], Response::HTTP_OK);
    }
}
