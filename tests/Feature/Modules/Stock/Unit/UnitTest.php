<?php

namespace Tests\Feature;

use App\Modules\Stock\Unit\Repository\Eloquent\Model\UnitModelEloquent;
use Tests\TestCase;

class UnitTest extends TestCase
{
    protected string $uri;

    public function setUp(): void
    {
        parent::setUp();
        $this->uri = '/api/stock/unit';
    }

    /**
     * Incluir Unit
     *
     * @return void
     */
    public function testStoreUnitFromUnitController()
    {
        $unitToStore = UnitModelEloquent::factory()->make()->toArray();
        $response = $this->json(
            "POST",
            $this->uri,
            $unitToStore
        );
        $expectedResponse = [
            'code',
            'error',
            'message',
            'data' => [
                'id',
                'abbreviation',
                'description',
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
        $this->assertDatabaseHas('unit', [
            'abbreviation' => $unitToStore['abbreviation'],
            'description'  => $unitToStore['description'],
        ]);        
    }

    /**
     * Localizar Unit
     *
     * @return void
     */
    public function testShowUnitFromUnitController()
    {
        $unitCreated = UnitModelEloquent::factory()->create();
        $response = $this->json(
            "GET",
            "{$this->uri}/{$unitCreated->id}",            
        );
        $expectedResponse = [
            'code',
            'error',
            'message',
            'data' => [
                'id',
                'abbreviation',
                'description',
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
     * Atualizar Unit
     *
     * @return void
     */
    public function testUpdateUnitFromUnitController()
    {
        $unitToUpdate = UnitModelEloquent::factory()->create();
        $unitToUpdate->name = $this->faker->name();

        $response = $this
            ->json(
                "PUT",
                "{$this->uri}/{$unitToUpdate->id}", 
                $unitToUpdate->toArray(),
            );
        $expectedResponse = [
            'code',
            'error',
            'message',
            'data' => [
                'id',
                'abbreviation',
                'description',
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
        $this->assertDatabaseHas('unit', [
            'id'           => $unitToUpdate['id'],
            'abbreviation' => $unitToUpdate['abbreviation'],
            'description'  => $unitToUpdate['description'],
        ]);                
    }

    public function testDestroyUnitFromUnitController()
    {
        $unitCreated  = UnitModelEloquent::factory()->create();
        $response = $this->deleteJson(
            "{$this->uri}/{$unitCreated->id}"
        );

        // Checar Status
        $response->assertStatus(204);            
    }

    public function testIndexUnitFromUnitController()
    {
        UnitModelEloquent::factory(10)->create();
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
                    'abbreviation',
                    'description',
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
