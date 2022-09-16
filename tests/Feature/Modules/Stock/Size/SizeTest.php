<?php

namespace Tests\Feature;

use Database\Factories\Modules\Stock\Size\Repository\SizeFactoryProvider;
use Tests\TestCase;

class SizeTest extends TestCase
{
    protected string $uri;

    public function setUp(): void
    {
        parent::setUp();
        $this->uri = '/api/stock/size';
    }

    /**
     * Incluir Size
     *
     * @return void
     */
    public function testStoreSizeFromSizeController()
    {
        $sizeToStore = SizeFactoryProvider::make()->generate();
        $response = $this->json(
            "POST",
            $this->uri,
            $sizeToStore
        );
        $expectedResponse = [
            'code',
            'error',
            'message',
            'data' => [
                'id',
                'name',
                'created_at',
                'updated_at',
                'created_by_user_id',
                'updated_by_user_id',
            ],
        ];        
        
        // Checar Status, Estrutura e Dados no Banco
        $response
            ->assertStatus(201)
            ->assertJsonStructure($expectedResponse);
        $this->assertDatabaseHas('size', [
            'name' => $sizeToStore['name'],
        ]);        
    }

    /**
     * Localizar Size
     *
     * @return void
     */
    public function testShowSizeFromSizeController()
    {
        $sizeCreated = SizeFactoryProvider::make()->create();
        $response = $this->json(
            "GET",
            "{$this->uri}/{$sizeCreated['id']}",            
        );
        $expectedResponse = [
            'code',
            'error',
            'message',
            'data' => [
                'id',
                'name',
                'created_at',
                'updated_at',
                'created_by_user_id',
                'updated_by_user_id',
            ],
        ];
        
        // Checar Status, Estrutura e Dados no Banco
        $response
            ->assertStatus(200)
            ->assertJsonStructure($expectedResponse);
    }

    /**
     * Atualizar Size
     *
     * @return void
     */
    public function testUpdateSizeFromSizeController()
    {
        $sizeToUpdate = SizeFactoryProvider::make()->create();
        $sizeToUpdate['name'] = $this->faker->name();

        $response = $this
            ->json(
                "PUT",
                "{$this->uri}/{$sizeToUpdate['id']}", 
                $sizeToUpdate,
            );
        $expectedResponse = [
            'code',
            'error',
            'message',
            'data' => [
                'id',
                'name',
                'created_at',
                'updated_at',
                'created_by_user_id',
                'updated_by_user_id',
            ],
        ];
        
        // Checar Status, Estrutura e Dados no Banco
        $response
            ->assertStatus(200)
            ->assertJsonStructure($expectedResponse);
        $this->assertDatabaseHas('size', [
            'id'   => $sizeToUpdate['id'],
            'name' => $sizeToUpdate['name'],
        ]);                
    }

    public function testDestroySizeFromSizeController()
    {
        $sizeCreated = SizeFactoryProvider::make()->create();
        $response = $this->deleteJson(
            "{$this->uri}/{$sizeCreated['id']}"
        );

        // Checar Status
        $response->assertStatus(204);            
    }

    public function testIndexSizeFromSizeController()
    {
        SizeFactoryProvider::make()->create(10);
        $response = $this
            ->json(
                "GET",
                $this->uri,
            );
        $expectedResponse = [
            'code',
            'error',
            'message',
            'data' => [
                "*" => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                    'created_by_user_id',
                    'updated_by_user_id',
                ]
            ],
        ];
        
        // Checar Status e Estrutura
        $response
            ->assertStatus(200)
            ->assertJsonStructure($expectedResponse);
    }
}
