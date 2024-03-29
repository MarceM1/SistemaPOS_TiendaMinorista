<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Caracteristica;
use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::with('caracteristica')->latest()->get();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();

            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->categoria()->create([
                'característica_id' => $caracteristica->id
            ]);

            DB::commit();
        } catch (Exception) {
            DB::rollBack();
        }

        return redirect()->route('categorias.index')->with('Success', 'Categoría creada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria, Caracteristica $caracteristica)
    {

        return view('categorias.edit', compact(['categoria', 'caracteristica']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        // Caracteristica::where('id', $categoria->caracteristica->id)->update($request->validated());
        $categoria->caracteristica->update($request->all());
        return redirect()->route('categorias.index')->with('Success', 'Categoría actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $message = "";
        $categoria = Categoria::find($id);

        if ($categoria->caracteristica->estado == 1) {
            Caracteristica::where('id', $categoria->caracteristica->id)->update(['estado' => '0']);
            $message = "Categoría eliminada!";
        } else {
            Caracteristica::where('id', $categoria->caracteristica->id)->update(['estado' => '1']);
            $message = "Categoría restaurada!";
        };



        return redirect()->route('categorias.index')->with('Success', $message);
    }
}
