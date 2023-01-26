<?php

namespace Tests\Feature\Repositories;

use App\Contracts\SpeciesContract;
use App\Models\Species\Species;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpeciesRepositoryTest extends TestCase
{
    /** @var SpeciesContract $speciesRepository */
    protected $speciesRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->speciesRepository = $this->app->make(SpeciesContract::class);
    }

    public function testCreate()
    {
        $speciesName = 'human';
        $speciesModel = $this->speciesRepository->create([
            'name' => $speciesName,
            'classification' => 'test classification',
            'designation' => 'test designation',
            'average_height' => 'test',
            'skin_colors' => 'color',
            'hair_colors' => 'color',
            'eye_colors' => 'color',
            'average_lifespan' => 'test',
            'language' => 'test',
        ]);

        $this->assertInstanceOf(Species::class, $speciesModel);

        $this->assertEquals($speciesName, $speciesModel->name);

        $this->assertDatabaseHas('species', [
            'name' => $speciesName,
        ]);

        $this->assertDatabaseCount('species', 1);
    }

    public function testFind()
    {
        $speciesName = 'human';
        $speciesModel = $this->speciesRepository->create([
            'name' => $speciesName,
            'classification' => 'test classification',
            'designation' => 'test designation',
            'average_height' => 'test',
            'skin_colors' => 'color',
            'hair_colors' => 'color',
            'eye_colors' => 'color',
            'average_lifespan' => 'test',
            'language' => 'test',
        ]);
        $speciesModel = $this->speciesRepository->find($speciesModel->id);
        $this->assertInstanceOf(Species::class, $speciesModel);
    }

    public function testUpdate()
    {
        $speciesName = 'human';
        $speciesModel = $this->speciesRepository->create([
            'name' => $speciesName,
            'classification' => 'test classification',
            'designation' => 'test designation',
            'average_height' => 'test',
            'skin_colors' => 'color',
            'hair_colors' => 'color',
            'eye_colors' => 'color',
            'average_lifespan' => 'test',
            'language' => 'test',
        ]);

        $this->speciesRepository->setModel($speciesModel);

        $newName = 'Jedi';

        $speciesModel = $this->speciesRepository->update(
            [
                'id' => $speciesModel->id,
            ],
            [
                'name' => $newName,
            ]
        );

        $this->assertInstanceOf(Species::class, $speciesModel);

        $this->assertEquals($newName, $speciesModel->name);
    }

    public function testDestroy()
    {
        $speciesName = 'jedi';
        $speciesModel = $this->speciesRepository->create([
            'name' => $speciesName,
            'classification' => 'test classification',
            'designation' => 'test designation',
            'average_height' => 'test',
            'skin_colors' => 'color',
            'hair_colors' => 'color',
            'eye_colors' => 'color',
            'average_lifespan' => 'test',
            'language' => 'test',
        ]);

        $this->speciesRepository->setModel($speciesModel);

        $speciesModel = $this->speciesRepository->destroy($speciesModel->id);

        $this->assertTrue($speciesModel);

        $this->assertDatabaseMissing('species', [
            'name' => $speciesName,
        ]);
    }
}
