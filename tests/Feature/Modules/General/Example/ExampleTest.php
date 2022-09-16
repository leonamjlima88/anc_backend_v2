<?php

namespace Tests\Feature;

use Database\Factories\Modules\General\Example\Repository\ExampleFactoryProvider;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected string $uri;

    public function setUp(): void
    {
        parent::setUp();
        $this->uri = '/api/general/example';
    }

    /**
     * Incluir Example
     *
     * @return void
     */
    public function testStoreExampleFromExampleController()
    {
        $exampleToStore = ExampleFactoryProvider::make()->generate();
        $response = $this->json(
            "POST",
            $this->uri,
            $exampleToStore
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
        $this->assertDatabaseHas('example', [
            'name' => $exampleToStore['name'],
        ]);        
    }

    /**
     * Localizar Example
     *
     * @return void
     */
    public function testShowExampleFromExampleController()
    {
        $exampleCreated = ExampleFactoryProvider::make()->create();
        $response = $this->json(
            "GET",
            "{$this->uri}/{$exampleCreated['id']}",            
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
     * Atualizar Example
     *
     * @return void
     */
    public function testUpdateExampleFromExampleController()
    {
        $exampleToUpdate = ExampleFactoryProvider::make()->create();
        $exampleToUpdate['name'] = $this->faker->name();

        $response = $this
            ->json(
                "PUT",
                "{$this->uri}/{$exampleToUpdate['id']}", 
                $exampleToUpdate,
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
        $this->assertDatabaseHas('example', [
            'id'   => $exampleToUpdate['id'],
            'name' => $exampleToUpdate['name'],
        ]);                
    }

    public function testDestroyExampleFromExampleController()
    {
        $exampleCreated = ExampleFactoryProvider::make()->create();
        $response = $this->deleteJson(
            "{$this->uri}/{$exampleCreated['id']}"
        );

        // Checar Status
        $response->assertStatus(204);            
    }

    public function testIndexExampleFromExampleController()
    {
        ExampleFactoryProvider::make()->create(15);
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
