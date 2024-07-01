<?php

namespace App\Repositories;

interface IndicesRepositoryInterface
{
    public function create(array $dados);

    public function update(array $dados, int $int);

    public function delete(int $id);

    public function find(int $id);

}
