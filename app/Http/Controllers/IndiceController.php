<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndiceRequest;
use App\Services\IndicesServices;

class IndiceController extends Controller
{
    protected $indicesServices;

    public function __construct(IndicesServices $indicesServices)
    {
        $this->indicesServices = $indicesServices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\IndiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndiceRequest $request)
    {
        $dados = $request->validated();
        $indice = $this->indicesServices->add($dados);
        return response()->json($indice, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\IndiceRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IndiceRequest $request, int $id)
    {
        $dados = $request->validated();
        $indice = $this->indicesServices->update($dados, $id);
        if($indice){
            return response()->json(['message' => 'Atualizado com sucesso',$indice], 200);
        }
        else {
            return response()->json(['message' => 'ops, não foi possivel atualizar'], 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->indicesServices->delete($id);
        if($deleted){
            return response()->json(['message' => 'Deletado com sucesso',$deleted], 204);
        }
        else {
            return response()->json(['message' => 'ops, alguma coisa deu errado'], 404);
        }
    }
}
