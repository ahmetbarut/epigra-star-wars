<?php

namespace Tests\Feature\Repositories;

use App\Contracts\PeopleContract;
use App\Models\People\People;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PeopleRepositoryTest extends TestCase
{
    /** @var PeopleContract $peopleRepository */
    protected $peopleRepository;

    protected int $peopleId = 0;

    protected function setUp(): void
    {
        parent::setUp();
        $this->peopleRepository = $this->app->make(PeopleContract::class);
    }

    public function testCreate()
    {
        $peopleName = 'Luke Skywalker';
        $peopleModel = $this->peopleRepository->create([
            'name' => $peopleName,
            'birth_year' => '19BBY',
            'height' => '172',
            'mass' => '77',
            'hair_color' => 'blond',
            'skin_color' => 'fair',
            'eye_color' => 'test eye color',
            'gender' => 'test gender',
            'homeworld' => 'test homeworld',
        ]);

        $this->assertInstanceOf(People::class, $peopleModel);

        $this->assertEquals($peopleName, $peopleModel->name);

        $this->assertDatabaseHas('people', [
            'name' => $peopleName,
        ]);

        $this->assertDatabaseCount('people', 1);
    }

    public function testFind()
    {
        $peopleName = 'Luke Skywalker';
        $peopleModel = $this->peopleRepository->create([
            'name' => $peopleName,
            'birth_year' => '19BBY',
            'height' => '172',
            'mass' => '77',
            'hair_color' => 'blond',
            'skin_color' => 'fair',
            'eye_color' => 'test eye color',
            'gender' => 'test gender',
            'homeworld' => 'test homeworld',
        ]);
        $peopleModel = $this->peopleRepository->find($peopleModel->id);
        $this->assertInstanceOf(People::class, $peopleModel);
    }

    public function testUpdate()
    {
        $peopleName = 'Luke Skywalker';
        $peopleModel = $this->peopleRepository->create([
            'name' => $peopleName,
            'birth_year' => '19BBY',
            'height' => '172',
            'mass' => '77',
            'hair_color' => 'blond',
            'skin_color' => 'fair',
            'eye_color' => 'test eye color',
            'gender' => 'test gender',
            'homeworld' => 'test homeworld',
        ]);

        $this->peopleRepository->setModel($peopleModel);

        $newName = 'Luke Skywalker 2';

        $peopleModel = $this->peopleRepository->update(
            [
                'id' => $peopleModel->id,
            ],
            [
                'name' => $newName,
            ]
        );

        $this->assertInstanceOf(People::class, $peopleModel);

        $this->assertEquals($newName, $peopleModel->name);
    }

    public function testDestroy()
    {
        $peopleName = 'Luke Skywalker';
        $peopleModel = $this->peopleRepository->create([
            'name' => $peopleName,
            'birth_year' => '19BBY',
            'height' => '172',
            'mass' => '77',
            'hair_color' => 'blond',
            'skin_color' => 'fair',
            'eye_color' => 'test eye color',
            'gender' => 'test gender',
            'homeworld' => 'test homeworld',
        ]);

        $this->peopleRepository->setModel($peopleModel);

        $peopleModel = $this->peopleRepository->destroy($peopleModel->id);

        $this->assertTrue($peopleModel);

        $this->assertDatabaseMissing('people', [
            'name' => $peopleName,
        ]);
    }
}
