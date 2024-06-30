<?php

    namespace App\Repositories;
    use App\Models\Livro;
    use Illuminate\Support\Facades\Auth;

    class LivrosRepository implements LivrosRepositoryInterface
    {
        public $livroModel;

        public  function __construct(Livro $livroModel )
        {
            $this->livroModel = $livroModel;

        }

        public function create(array $dados)
        {
            $dados['usuario_publicador_id'] =  Auth::user()->id;
            return $this->livroModel->create($dados);
        }

        public function getAllWithFilters($tituloLivro = null, $tituloIndice = null)
        {
            $query = $this->livroModel->query();

            if ($tituloLivro) {
                $query->where('titulo', 'like', '%' . $tituloLivro . '%');
            }

            if ($tituloIndice) {
                $query->whereHas('indices', function ($q) use ($tituloIndice) {
                    $q->where('titulo', 'like', '%' . $tituloIndice . '%');
                });
            }

            return $query->with('indices')->get();
        }

        public function update(array $dados, int $id)
        {
            $livro = $this->livroModel->findOrFail($id);
            $livro->update($dados);
            return $livro;
        }
        public function delete(int $id)
        {
            $livro = $this->livroModel->findOrFail($id);
            $livro->delete();
            return $livro;
        }

        public function list()
        {
            return $this->livroModel->all();
        }

        public function find(int $id)
        {
            return $this->livroModel->findOrFail($id);
        }
    }
