<?php

namespace Tests\Unit;

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

    public function testAddLivro()
    {
        // Dados simulados de um novo livro
        $livroData = [
            'titulo' => 'Novo Livro',
            'usuario_publicador_id' => 1,
            'indices' => [
                [
                    'titulo' => 'Índice 1',
                    'pagina' => 10,
                    'subindices' => [
                        [
                            'titulo' => 'Subíndice 1.1',
                            'pagina' => 12,
                        ],
                    ],
                ],
            ],
        ];

        // Configuração do mock
        $this->livrosRepositoryMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($data) use ($livroData) {
                // Verifica se os dados passados correspondem aos esperados
                return $data['titulo'] === $livroData['titulo']
                    && $data['usuario_publicador_id'] === $livroData['usuario_publicador_id'];
            }))
            ->willReturn((object) $livroData);

        $livroCriado = $this->livrosService->add($livroData);

        $this->assertInstanceOf(\stdClass::class, $livroCriado);
        $this->assertEquals('Novo Livro', $livroCriado->titulo);
        $this->assertCount(1, $livroCriado->indices);
        $this->assertEquals('Índice 1', $livroCriado->indices[0]->titulo);
        $this->assertCount(1, $livroCriado->indices[0]->subindices);
        $this->assertEquals('Subíndice 1.1', $livroCriado->indices[0]->subindices[0]->titulo);
    }

}

