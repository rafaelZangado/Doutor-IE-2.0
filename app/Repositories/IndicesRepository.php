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

    public function create(array $dados)
    {
        return $this->indiceModel->create($dados);
    }

    
}
