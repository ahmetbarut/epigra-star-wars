<?php

namespace Tests\Feature\Console\Commands;

use App\Console\Commands\SyncDatabaseApiData;
use App\Contracts\PeopleContract;
use App\Contracts\SpeciesContract;
use App\Events\SyncDatabaseCommandEndedEvent;
use App\Events\SyncDatabaseCommandStartedEvent;
use App\Jobs\CreateVehiclesForPeopleJob;
use App\Jobs\FetchPeoplesJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Mockery\Mock;
use Tests\TestCase;

/**
 * Class SyncDatabaseApiDataTest.
 *
 * @covers \App\Console\Commands\SyncDatabaseApiData
 */
final class SyncDatabaseApiDataTest extends TestCase
{
    private SyncDatabaseApiData $syncDatabaseApiData;

    private PeopleContract $peopleRepository;

    private SpeciesContract $speciesRepository;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->peopleRepository = app(PeopleContract::class);
        $this->speciesRepository = app(SpeciesContract::class);
        $this->syncDatabaseApiData = new SyncDatabaseApiData($this->peopleRepository, $this->speciesRepository);
        $this->app->instance(SyncDatabaseApiData::class, $this->syncDatabaseApiData);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->syncDatabaseApiData);
        unset($this->peopleRepository);
        unset($this->speciesRepository);
    }

    public function testHandle(): void
    {
        Bus::fake();
        Event::fake();

        /** @todo This test is incomplete. */
        $this
            ->artisan('sync:database-api-data')
            ->assertExitCode(0);

        Event::assertDispatched(SyncDatabaseCommandStartedEvent::class);
        Event::assertDispatched(SyncDatabaseCommandEndedEvent::class);
        Bus::assertDispatched(FetchPeoplesJob::class);
    }
}
