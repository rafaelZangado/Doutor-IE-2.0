<?php

    namespace App\Services;
    use App\Repositories\LivrosRepository;

    class LivrosServices{

        public $livrosRepository;

        public function __construct(LivrosRepository $livrosRepository)
        {
            $this->livrosRepository = $livrosRepository;
        }

        /**
         * Adiciona um novo livro com seus índices.
         *
         * @param array $dados Dados do livro a ser adicionado
         * @return mixed O modelo de livro criado
         */
        public function add(array $dados)
        {
            $indices = $dados['indices'] ?? null;
            unset($dados['indices']); // Remove os índices do array principal

            $livro = $this->livrosRepository->create($dados);

            if ($indices) {
                $this->adicionarIndices($livro, $indices);
            }

            return $livro;
        }

        public function edit(array $dados, int $id)
        {
            return $this->livrosRepository->update($dados, $id);
        }

        public function remove(int $id)
        {
            return $this->livrosRepository->delete($id);
        }

        public function getAll()
        {
            return $this->livrosRepository->list();
        }
        public function getById(int $id)
        {
            return $this->livrosRepository->find($id);
        }

        /**
         * Recupera todos os livros com opções de filtro por título do livro e título do índice.
         *
         * @param string|null $tituloLivro Título do livro para filtrar
         * @param string|null $tituloIndice Título do índice para filtrar
         * @return mixed Resultado da consulta de livros
         */
        public function getAllWithFilters($tituloLivro = null, $tituloIndice = null)
        {
            return $this->livrosRepository->getAllWithFilters($tituloLivro, $tituloIndice);
        }

        /**
         * Adiciona os índices associados ao livro.
         *
         * @param mixed $livro Modelo de livro ao qual os índices serão associados
         * @param array $indices Dados dos índices a serem adicionados
         * @return void
         */
        protected function adicionarIndices($livro, $indices)
        {
            foreach ($indices as $indice) {
                $this->criarIndice($livro, $indice);
            }
        }

        /**
         * Cria um índice associado ao livro, incluindo subíndices se existirem.
         *
         * @param mixed $livro Modelo de livro ao qual o índice será associado
         * @param array $indice Dados do índice a ser criado
         * @return mixed O modelo de índice criado
         */
        protected function criarIndice($livro, $indice)
        {
            $subindices = $indice['subindices'] ?? [];

            $indiceCriado = $livro->indices()->create([
                'titulo' => $indice['titulo'],
                'pagina' => $indice['pagina'],
            ]);

            foreach ($subindices as $subindice) {
                $this->criarIndice($livro, $subindice);
            }

            return $indiceCriado;
        }
    }
