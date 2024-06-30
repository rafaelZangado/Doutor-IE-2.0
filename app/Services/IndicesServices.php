<?php

namespace App\Services;

use App\Repositories\IndicesRepositoryInterface;

class IndicesServices
{
    public $indicesRepository;

    public function __construct(IndicesRepositoryInterface $indicesRepository)
    {
        $this->indicesRepository = $indicesRepository;
    }

    public function add(array $dados)
    {

        $indices = $dados['indices'] ?? null;
        unset($dados['indices']);

        $indice = $this->indicesRepository->create($dados);

        if ($indices) {
            $this->adicionarSubindices($indice, $indices);
        }

        return $indice;
    }

    /**
     * Adiciona os subíndices associados a um índice.
     *
     * @param mixed $indice Modelo de índice ao qual os subíndices serão associados
     * @param array $subindices Dados dos subíndices a serem adicionados
     * @return void
     */
    protected function adicionarSubindices($indice, $subindices)
    {
        foreach ($subindices as $subindice) {
            $this->criarSubindice($indice, $subindice);
        }
    }

    /**
     * Cria um subíndice associado a um índice.
     *
     * @param mixed $indice Modelo de índice ao qual o subíndice será associado
     * @param array $subindice Dados do subíndice a ser criado
     * @return mixed O modelo de subíndice criado
     */
    protected function criarSubindice($indice, $subindice)
    {
        $subindiceCriado = $indice->indicesFilhos()->create([
            'titulo' => $subindice['titulo'],
            'pagina' => $subindice['pagina'],
        ]);

        if (isset($subindice['subindices']) && is_array($subindice['subindices'])) {
            $this->adicionarSubindices($subindiceCriado, $subindice['subindices']);
        }

        return $subindiceCriado;
    }

    
}
