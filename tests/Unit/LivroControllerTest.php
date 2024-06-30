<?php

namespace Tests\Unit;

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

    public function testStoreLivro()
    {
        // POST
        $livroData = [
            'titulo' => 'Novo Livro',
            'usuario_publicador_id' => 1,
        ];

        // Configuração do mock
        $this->livrosServiceMock->expects($this->once())
            ->method('add')
            ->with($livroData)
            ->willReturn((object) $livroData);
        $response = $this->post('/api/v1/livros', $livroData);


        $response->assertStatus(201);
        $response->assertJsonFragment($livroData);
    }

  
}
