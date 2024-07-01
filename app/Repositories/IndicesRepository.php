<?php

namespace App\Repositories;

use App\Models\Indice;

class IndicesRepository implements IndicesRepositoryInterface
{
    public $indiceModel;

    public function __construct(Indice $indiceModel)
    {
        $this->indiceModel = $indiceModel;
    }

    /**
     * recebe os dados .
     *
     * @param  array  $dados
     */
    public function create(array $dados)
    {
        return $this->indiceModel->create($dados);
    }

    public function update(array $dados, int $id)
    {
        $indice = $this->find($id);
        if ($indice) {
            $indice->update($dados);
            return $indice;
        }
        return null;
    }

    public function delete(int $id)
    {
        $indice = $this->find($id);
        if ($indice) {
            $indice->delete();
            return true;
        }
        return false;
    }

    public function find(int $id)
    {
        return $this->indiceModel->find($id);
    }
}
