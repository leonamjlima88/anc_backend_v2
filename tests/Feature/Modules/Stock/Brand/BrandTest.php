<?php

namespace Tests\Feature;

use Database\Factories\Modules\Stock\Brand\Repository\BrandFactoryProvider;
use Tests\TestCase;

class BrandTest extends TestCase
{
    protected string $uri;

    public function setUp(): void
    {
        parent::setUp();
        $this->uri = '/api/stock/brand';
    }

    /**
     * Incluir Brand
     *
     * @return void
     */
    public function testStoreBrandFromBrandController()
    {
        $brandToStore = BrandFactoryProvider::make()->generate();
        $response = $this->json(
            "POST",
            $this->uri,
            $brandToStore
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
        $this->assertDatabaseHas('brand', [
            'name' => $brandToStore['name'],
        ]);        
    }

    /**
     * Localizar Brand
     *
     * @return void
     */
    public function testShowBrandFromBrandController()
    {
        $brandCreated = BrandFactoryProvider::make()->create();
        $response = $this->json(
            "GET",
            "{$this->uri}/{$brandCreated['id']}",            
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
     * Atualizar Brand
     *
     * @return void
     */
    public function testUpdateBrandFromBrandController()
    {
        $brandToUpdate = BrandFactoryProvider::make()->create();
        $brandToUpdate['name'] = $this->faker->name();

        $response = $this
            ->json(
                "PUT",
                "{$this->uri}/{$brandToUpdate['id']}", 
                $brandToUpdate,
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
        $this->assertDatabaseHas('brand', [
            'id'   => $brandToUpdate['id'],
            'name' => $brandToUpdate['name'],
        ]);                
    }

    public function testDestroyBrandFromBrandController()
    {
        $brandCreated = BrandFactoryProvider::make()->create();
        $response = $this->deleteJson(
            "{$this->uri}/{$brandCreated['id']}"
        );

        // Checar Status
        $response->assertStatus(204);            
    }

    public function testIndexBrandFromBrandController()
    {
        BrandFactoryProvider::make()->create(15);
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
