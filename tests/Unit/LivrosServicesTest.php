<?php

namespace Tests\Unit;

use App\Models\Indice;
use App\Models\Livro;
use App\Models\User;
use Tests\TestCase;
use App\Services\LivrosServices;
use App\Repositories\LivrosRepository;

class LivrosServicesTest extends TestCase
{
    protected $livrosService;
    protected $livrosRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock do repositório de livros
        $this->livrosRepositoryMock = $this->createMock(LivrosRepository::class);
        $this->livrosService = new LivrosServices($this->livrosRepositoryMock);
    }

    public function testCadastroIndice()
    {
        $livro = Livro::factory()->create();

        $this->actingAs($livro);

        $dados = [
            'livro_id' => $livro->id,
            'titulo' => 'Novo Índice',
            'pagina' => 10,
        ];

        $response = $this->postJson('/api/v1/indices', $dados);

        $response->assertStatus(201);

        $response->assertJson([
            'livro_id' => $livro->id,
            'titulo' => 'Novo Índice',
            'pagina' => 10,
        ]);

        $this->assertDatabaseHas('indices', [
            'livro_id' => $livro->id,
            'titulo' => 'Novo Índice',
            'pagina' => 10,
        ]);
    }

    public function testAtualizarIndice()
    {
        $indice = Indice::factory()->create([
            'titulo' => 'Índice Antigo',
            'pagina' => 5,
        ]);

        $dadosAtualizados = [
            'titulo' => 'Índice Atualizado',
            'pagina' => 15,
        ];

        $response = $this->putJson("/api/v1/indices/{$indice->id}", $dadosAtualizados);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $indice->id,
                'titulo' => 'Índice Atualizado',
                'pagina' => 15,
            ]);
    }

}

