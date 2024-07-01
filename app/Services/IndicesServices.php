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

    public function update(array $dados, int $id)
    {
        return $this->indicesRepository->update($dados, $id);
    }

    public function delete(int $id)
    {
        return $this->indicesRepository->delete($id);
    }

    public function find(int $id)
    {
        return $this->indicesRepository->find($id);
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


    /**
     * Importar índices XML para um livro específico.
     *
     * @param int $livroId
     * @param string $xmlData
     * @return bool
     */
    public function importarIndices(int $livroId, string $xmlData): bool
    {


        $indices = $this->parseXML($xmlData);

        foreach ($indices as $indice) {
            $dados = [
                'livro_id' => $livroId,
                'indice_pai_id' => $indice['indice_pai_id'],
                'titulo' => $indice['titulo'],
                'pagina' => $indice['pagina'],
            ];

            $this->indicesRepository->create($dados);
        }

        return true;
    }

    /**
     * Exemplo simplificado de parse de XML.
     *
     * @param string $xmlData
     * @return array
     */
    protected function parseXML(string $xmlData): array
    {

        return [
            ['indice_pai_id' => 1, 'titulo' => 'Título 1', 'pagina' => 10],
            ['indice_pai_id' => null, 'titulo' => 'Título 2', 'pagina' => 20],
        ];
    }
}
