<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Services\IndicesServices;
use App\Services\LivrosServices;
use Illuminate\Http\Request;

class LivroController extends Controller
{


    public $livrosServices;


    public function __construct(
        LivrosServices $livrosServices,
        IndicesServices $indicesServices
    )
    {
        $this->livrosServices =  $livrosServices;
        $this->indicesServices = $indicesServices;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $livros = $this->livrosServices->getAllWithFilters($request->titulo, $request->titulo_do_indice);
        return response()->json($livros);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LivroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LivroRequest $request)
    {
        $data = $request->validated();
        $resposta = $this->livrosServices->add($data);
        return response()->json($resposta, 201);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livro = $this->livrosServices->getById($id);
        return response()->json($livro, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\LivroRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LivroRequest $request, $id)
    {
        $dados = $request->validated();
        $livro = $this->livrosServices->edit($dados, $id);

        return $livro ?
            response()->json(['message' => 'Livro atualizado com sucesso', 'data' => $livro], 200) :
            response()->json(['message' => 'ops, não foi possivel atualizar'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livro = $this->livrosServices->remove($id);

        return response()->json(['message' => 'Livro excluído com sucesso'], 200);
    }


    /**
    * Importar índices XML para um livro específico.
    *
    * @param  int  $livroId
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function importarIndicesXML($livroId, Request $request)
    {

        $xmlData = $request->input('xml_data');
        $resposta = $this->indicesServices->importarIndices($livroId, $xmlData);
        return response()->json(['message' => 'Índices XML importados com sucesso para o livro ' . $resposta, $resposta]);
    }

}
