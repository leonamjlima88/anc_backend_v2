<?php

namespace Tests\Feature;

use App\Modules\Stock\Brand\Repository\Eloquent\Model\BrandModelEloquent;
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
        $brandToStore = BrandModelEloquent::factory()->make()->toArray();
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
        $brandCreated = BrandModelEloquent::factory()->create();
        $response = $this->json(
            "GET",
            "{$this->uri}/{$brandCreated->id}",            
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
        $brandToUpdate = BrandModelEloquent::factory()->create();
        $brandToUpdate->name = $this->faker->name();

        $response = $this
            ->json(
                "PUT",
                "{$this->uri}/{$brandToUpdate->id}", 
                $brandToUpdate->toArray(),
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
            'id'          => $brandToUpdate['id'],
            'name'        => $brandToUpdate['name'],
        ]);                
    }

    public function testDestroyBrandFromBrandController()
    {
        $brandCreated  = BrandModelEloquent::factory()->create();
        $response = $this->deleteJson(
            "{$this->uri}/{$brandCreated->id}"
        );

        // Checar Status
        $response->assertStatus(204);            
    }

    public function testIndexBrandFromBrandController()
    {
        BrandModelEloquent::factory(10)->create();
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
