<?php

namespace Tests\Feature;

use Database\Factories\Modules\General\Person\Repository\PersonFactoryProvider;
use Tests\TestCase;

class PersonTest extends TestCase
{
    protected string $uri;

    public function setUp(): void
    {
        parent::setUp();
        $this->uri = '/api/general/person';
    }

    /**
     * Incluir Person
     *
     * @return void
     */
    public function testStorePersonFromPersonController()
    {
        $personToStore = PersonFactoryProvider::make()->generate();
        $response = $this->json(
            "POST",
            $this->uri,
            $personToStore
        );
        $expectedResponse = [
            'code',
            'error',
            'message',
            'data' => [
                'id',
                'business_name',
                'alias_name',
                'ein',
                'icms_taxpayer',
                'state_registration',
                'municipal_registration',
                'zipcode',
                'address',
                'address_number',
                'complement',
                'district',
                'city_id',
                'reference_point',
                'phone_1',
                'phone_2',
                'phone_3',
                'company_email',
                'financial_email',
                'internet_page',
                'note',
                'bank_note',
                'commercial_note',
                'is_customer',
                'is_seller',
                'is_supplier',
                'is_carrier',
                'is_technician',
                'is_employee',
                'is_other',
                'is_final_customer',
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
        $this->assertDatabaseHas('person', [
            'business_name' => $personToStore['business_name'],
            'alias_name' => $personToStore['alias_name'],
            'ein' => $personToStore['ein'],
            'address' => $personToStore['address'],
            'address_number' => $personToStore['address_number'],
            'district' => $personToStore['district'],
            'city_id' => $personToStore['city_id'],
            'is_customer' => $personToStore['is_customer'],
            'is_final_customer' => $personToStore['is_final_customer'],
            'phone_1' => $personToStore['phone_1'],
            'company_email' => $personToStore['company_email'],      
        ]);        
    }

    /**
     * Localizar Person
     *
     * @return void
     */
    public function testShowPersonFromPersonController()
    {
        $personCreated = PersonFactoryProvider::make()->create();
        $response = $this->json(
            "GET",
            "{$this->uri}/{$personCreated['id']}",            
        );
        $expectedResponse = [
            'code',
            'error',
            'message',
            'data' => [
                'id',
                'business_name',
                'alias_name',
                'ein',
                'icms_taxpayer',
                'state_registration',
                'municipal_registration',
                'zipcode',
                'address',
                'address_number',
                'complement',
                'district',
                'city_id',
                'reference_point',
                'phone_1',
                'phone_2',
                'phone_3',
                'company_email',
                'financial_email',
                'internet_page',
                'note',
                'bank_note',
                'commercial_note',
                'is_customer',
                'is_seller',
                'is_supplier',
                'is_carrier',
                'is_technician',
                'is_employee',
                'is_other',
                'is_final_customer',
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
     * Atualizar Person
     *
     * @return void
     */
    public function testUpdatePersonFromPersonController()
    {
        $personToUpdate = PersonFactoryProvider::make()->create();
        $personToUpdate['name'] = $this->faker->name();

        $response = $this
            ->json(
                "PUT",
                "{$this->uri}/{$personToUpdate['id']}", 
                $personToUpdate,
            );
        $expectedResponse = [
            'code',
            'error',
            'message',
            'data' => [
                'id',
                'business_name',
                'alias_name',
                'ein',
                'icms_taxpayer',
                'state_registration',
                'municipal_registration',
                'zipcode',
                'address',
                'address_number',
                'complement',
                'district',
                'city_id',
                'reference_point',
                'phone_1',
                'phone_2',
                'phone_3',
                'company_email',
                'financial_email',
                'internet_page',
                'note',
                'bank_note',
                'commercial_note',
                'is_customer',
                'is_seller',
                'is_supplier',
                'is_carrier',
                'is_technician',
                'is_employee',
                'is_other',
                'is_final_customer',
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
        $this->assertDatabaseHas('person', [
            'id'            => $personToUpdate['id'],
            'business_name' => $personToUpdate['business_name'],
        ]);                
    }

    public function testDestroyPersonFromPersonController()
    {
        $personCreated = PersonFactoryProvider::make()->create();
        $response = $this->deleteJson(
            "{$this->uri}/{$personCreated['id']}"
        );

        // Checar Status
        $response->assertStatus(204);            
    }

    public function testIndexPersonFromPersonController()
    {
        PersonFactoryProvider::make()->create(15);
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
                    'business_name',
                    'alias_name',
                    'ein',
                    'icms_taxpayer',
                    'state_registration',
                    'municipal_registration',
                    'zipcode',
                    'address',
                    'address_number',
                    'complement',
                    'district',
                    'city_id',
                    'reference_point',
                    'phone_1',
                    'phone_2',
                    'phone_3',
                    'company_email',
                    'financial_email',
                    'internet_page',
                    'note',
                    'bank_note',
                    'commercial_note',
                    'is_customer',
                    'is_seller',
                    'is_supplier',
                    'is_carrier',
                    'is_technician',
                    'is_employee',
                    'is_other',
                    'is_final_customer',
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
