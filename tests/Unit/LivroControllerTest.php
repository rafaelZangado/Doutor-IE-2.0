<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use App\Models\Livro;
use App\Services\LivrosServices;

class LivroControllerTest extends TestCase
{
    protected $livrosServiceMock;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock
        $this->livrosServiceMock = $this->createMock(LivrosServices::class);
    }

    public function testeParaCadastrarLivro()
    {
        // POST
        $user = User::factory()->create();
        $this->actingAs($user);

        $livroData = [
            'titulo' => 'Livro de Teste',
        ];

        $response = $this->postJson('/api/v1/livros', $livroData);

        $response->assertStatus(201)
            ->assertJson([
                'titulo' => 'Livro de Teste',
            ]);

        $livro = Livro::where('titulo', 'Livro de Teste')->first();
        $this->assertNotNull($livro);

    }

    public function testeParaEditarLivro()
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        // Criar um livro inicial
        $livro = Livro::factory()->create([
            'titulo' => 'Livro Antigo',
            'usuario_publicador_id' => $user->id,
        ]);

        $response = $this->putJson('/api/v1/livros/' . $livro->id, [
            'titulo' => 'Livro Atualizado',
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Livro atualizado com sucesso',
                    'data' => [
                        'id' => $livro->id,
                        'titulo' => 'Livro Atualizado',
                    ],
                ]);

        $livroAtualizado = Livro::find($livro->id);
        $this->assertEquals('Livro Atualizado', $livroAtualizado->titulo);
    }

}
