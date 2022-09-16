<?php

namespace Tests\Feature;

use Database\Factories\Modules\Stock\StorageLocation\Repository\StorageLocationFactoryProvider;
use Tests\TestCase;

class StorageLocationTest extends TestCase
{
    protected string $uri;

    public function setUp(): void
    {
        parent::setUp();
        $this->uri = '/api/stock/storage-location';
    }

    /**
     * Incluir StorageLocation
     *
     * @return void
     */
    public function testStoreStorageLocationFromStorageLocationController()
    {
        $storageLocationToStore = StorageLocationFactoryProvider::make()->generate();
        $response = $this->json(
            "POST",
            $this->uri,
            $storageLocationToStore
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
        $this->assertDatabaseHas('storage_location', [
            'name' => $storageLocationToStore['name'],
        ]);        
    }

    /**
     * Localizar StorageLocation
     *
     * @return void
     */
    public function testShowStorageLocationFromStorageLocationController()
    {
        $storageLocationCreated = StorageLocationFactoryProvider::make()->create();
        $response = $this->json(
            "GET",
            "{$this->uri}/{$storageLocationCreated['id']}",            
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
     * Atualizar StorageLocation
     *
     * @return void
     */
    public function testUpdateStorageLocationFromStorageLocationController()
    {
        $storageLocationToUpdate = StorageLocationFactoryProvider::make()->create();
        $storageLocationToUpdate['name'] = $this->faker->name();

        $response = $this
            ->json(
                "PUT",
                "{$this->uri}/{$storageLocationToUpdate['id']}", 
                $storageLocationToUpdate,
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
        $this->assertDatabaseHas('storage_location', [
            'id'   => $storageLocationToUpdate['id'],
            'name' => $storageLocationToUpdate['name'],
        ]);                
    }

    public function testDestroyStorageLocationFromStorageLocationController()
    {
        $storageLocationCreated = StorageLocationFactoryProvider::make()->create();
        $response = $this->deleteJson(
            "{$this->uri}/{$storageLocationCreated['id']}"
        );

        // Checar Status
        $response->assertStatus(204);            
    }

    public function testIndexStorageLocationFromStorageLocationController()
    {
        StorageLocationFactoryProvider::make()->create(10);
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
