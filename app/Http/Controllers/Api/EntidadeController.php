<?php

namespace App\Http\Controllers\Api;

use App\Models\Entidade;
use Illuminate\Http\Request;
use App\Http\Requests\EntidadeRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntidadeResource;

class EntidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $entidades = Entidade::paginate();

        return EntidadeResource::collection($entidades);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntidadeRequest $request): Entidade
    {
        return Entidade::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Entidade $entidade): Entidade
    {
        return $entidade;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntidadeRequest $request, Entidade $entidade): Entidade
    {
        $entidade->update($request->validated());

        return $entidade;
    }

    public function destroy(Entidade $entidade): Response
    {
        $entidade->delete();

        return response()->noContent();
    }
}
