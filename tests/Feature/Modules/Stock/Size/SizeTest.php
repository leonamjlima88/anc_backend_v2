<?php

namespace Tests\Feature;

use App\Modules\Stock\Size\Repository\Eloquent\Model\SizeModelEloquent;
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
        $sizeToStore = SizeModelEloquent::factory()->make()->toArray();
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
        $sizeCreated = SizeModelEloquent::factory()->create();
        $response = $this->json(
            "GET",
            "{$this->uri}/{$sizeCreated->id}",            
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
        $sizeToUpdate = SizeModelEloquent::factory()->create();
        $sizeToUpdate->name = $this->faker->name();

        $response = $this
            ->json(
                "PUT",
                "{$this->uri}/{$sizeToUpdate->id}", 
                $sizeToUpdate->toArray(),
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
            'id'          => $sizeToUpdate['id'],
            'name'        => $sizeToUpdate['name'],
        ]);                
    }

    public function testDestroySizeFromSizeController()
    {
        $sizeCreated  = SizeModelEloquent::factory()->create();
        $response = $this->deleteJson(
            "{$this->uri}/{$sizeCreated->id}"
        );

        // Checar Status
        $response->assertStatus(204);            
    }

    public function testIndexSizeFromSizeController()
    {
        SizeModelEloquent::factory(10)->create();
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
