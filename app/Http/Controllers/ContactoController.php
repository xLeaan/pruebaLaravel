<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contactos = Contacto::all();
        return response()->json($contactos, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('contactos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|unique:contactos,nombre',
            'email' => 'nullable|email|unique:contactos,email',
            'entidad_id' => 'nullable|exists:entidades,id',
            'identificacion' => 'required|unique:contactos,identificacion',
        ]);
    
        $contacto = Contacto::create($validatedData);
    
        return response()->json($contacto, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $contacto = Contacto::find($id);

        if (!$contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($contacto, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contacto $contacto)
    {
        //
        return view('contactos.edit', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $contacto = Contacto::find($id);

        if (!$contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $validateData = $request->validate([
            'nombre' => 'required|unique:contactos,nombre,'. $contacto->id,
            'email' => 'nullable|email|unique:contactos,email,'. $contacto->id,
            'entidad_id' => 'nullable|exists:entidades,id',
            'identificacion' => 'required|unique:contactos,identificacion,' . $contacto->id,
        ]);

        $contacto->update($validateData);

        return response()->json($contacto, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $contacto = Contacto::find($id);
        if(!$contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $contacto->delete();

       return response()->json(['message' => 'Contacto eliminado exitosamente'], Response::HTTP_OK);
    }
}
