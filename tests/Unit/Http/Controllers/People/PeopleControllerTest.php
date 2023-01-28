<?php

namespace Tests\Unit\Http\Controllers\People;

use App\Models\People\People;
use App\Models\User;
use Tests\TestCase;

class PeopleControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @group people
     */
    public function testGetAllRecords()
    {
        People::factory()->count(10)->create();
        $user = $this->createUser();

        //
        $response = $this->actingAs($user)->get('/api/people');
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');

        $response->assertJsonStructure(
            [
                'data' =>
                [
                    '*' =>
                    [
                        'id',
                        'birth_year',
                        'eye_color',
                        'gender',
                        'hair_color',
                        'height',
                        'homeworld',
                        'mass',
                        'name',
                        'skin_color',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]
        );
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @group people
     */
    public function testGetRecord()
    {
        $user = $this->createUser();
        $people = People::factory()->create();

        $this->actingAs($user)
            ->get('/api/people/' . $people->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' =>
                [
                    'id',
                    'birth_year',
                    'eye_color',
                    'gender',
                    'hair_color',
                    'height',
                    'homeworld',
                    'mass',
                    'name',
                    'skin_color',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    /**
     * @return User
     */
    public function createUser(): User
    {
        return User::factory()->create();
    }
}
