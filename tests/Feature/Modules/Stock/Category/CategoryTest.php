<?php

namespace Tests\Feature;

use Database\Factories\Modules\Stock\Category\Repository\CategoryFactoryProvider;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    protected string $uri;

    public function setUp(): void
    {
        parent::setUp();
        $this->uri = '/api/stock/category';
    }

    /**
     * Incluir Category
     *
     * @return void
     */
    public function testStoreCategoryFromCategoryController()
    {
        $categoryToStore = CategoryFactoryProvider::make()->generate();
        $response = $this->json(
            "POST",
            $this->uri,
            $categoryToStore
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
        $this->assertDatabaseHas('category', [
            'name' => $categoryToStore['name'],
        ]);        
    }

    /**
     * Localizar Category
     *
     * @return void
     */
    public function testShowCategoryFromCategoryController()
    {
        $categoryCreated = CategoryFactoryProvider::make()->create();
        $response = $this->json(
            "GET",
            "{$this->uri}/{$categoryCreated['id']}",            
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
     * Atualizar Category
     *
     * @return void
     */
    public function testUpdateCategoryFromCategoryController()
    {
        $categoryToUpdate = CategoryFactoryProvider::make()->create();
        $categoryToUpdate['name'] = $this->faker->name();

        $response = $this
            ->json(
                "PUT",
                "{$this->uri}/{$categoryToUpdate['id']}", 
                $categoryToUpdate,
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
        $this->assertDatabaseHas('category', [
            'id'   => $categoryToUpdate['id'],
            'name' => $categoryToUpdate['name'],
        ]);                
    }

    public function testDestroyCategoryFromCategoryController()
    {
        $categoryCreated = CategoryFactoryProvider::make()->create();
        $response = $this->deleteJson(
            "{$this->uri}/{$categoryCreated['id']}"
        );

        // Checar Status
        $response->assertStatus(204);            
    }

    public function testIndexCategoryFromCategoryController()
    {
        CategoryFactoryProvider::make()->create(15);
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
