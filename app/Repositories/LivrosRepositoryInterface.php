<?php

    namespace App\Repositories;
    interface LivrosRepositoryInterface
    {
        public function create(array $dados);
        public function update(array $dados, int $id);
        public function delete(int $id);
        public function list();
        public function find(int $id);
        public function getAllWithFilters($tituloLivro = null, $tituloIndice = null);
    }
