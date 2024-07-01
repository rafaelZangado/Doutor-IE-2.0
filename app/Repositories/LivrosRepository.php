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

        /**
         * Create a new livro record.
         *
         * @param  array  $dados
         * @return Livro
         */
        public function create(array $dados)
        {
            $dados['usuario_publicador_id'] =  Auth::user()->id;
            return $this->livroModel->create($dados);
        }

        /**
         * Get all livros with optional filtering by tituloLivro and tituloIndice.
         *
         * @param  string|null  $tituloLivro
         * @param  string|null  $tituloIndice
         * @return \Illuminate\Database\Eloquent\Collection
         */
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

        /**
         * Update an existing livro record.
         *
         * @param  array  $dados
         * @param  int  $id
         * @return Livro
         */
        public function update(array $dados, int $id)
        {
            $livro = $this->livroModel->findOrFail($id);
            $livro->update($dados);
            return $livro;
        }

        /**
         * Delete a livro record.
         *
         * @param  int  $id
         * @return Livro
         */
        public function delete(int $id)
        {
            $livro = $this->livroModel->findOrFail($id);
            $livro->delete();
            return $livro;
        }

        /**
         * Get all livros.
         *
         * @return \Illuminate\Database\Eloquent\Collection
         */
        public function list()
        {
            return $this->livroModel->all();
        }

        /**
         * Find a livro by ID.
         *
         * @param  int  $id
         * @return Livro
         */
        public function find(int $id)
        {
            return $this->livroModel->findOrFail($id);
        }
    }
