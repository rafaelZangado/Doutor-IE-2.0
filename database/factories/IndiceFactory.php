<?php

use App\Models\Indice;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\Factory;

class IndiceFactory extends Factory
{
    protected $model = Indice::class;

    public function definition()
    {
        $livro = Livro::factory()->create();

        return [
            'livro_id' => $livro->id,
            'indice_pai_id' => null,
            'titulo' => $this->faker->sentence(),
            'pagina' => $this->faker->numberBetween(1, 100),
        ];
    }
}
