<?php

namespace App\Console\Commands;

use App\Jobs\FetchPeoplesJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncDatabaseApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:database-api-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Her çalıştırıldığında, veritabanındaki verileri API\'dan günceller.';

    public function __construct(
        protected \App\Contracts\PeopleContract $peopleRepository,
        protected \App\Contracts\SpeciesContract $speciesRepository,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Veritabanı verileri API\'dan güncelleniyor...');

        $baseUrl = 'https://swapi.dev/api';

        $response = Http::get($baseUrl . '/species')
            ->throw()
            ->object();

        $page = ceil($response->count / 10);

        $species = collect();

        for ($i = 1; $i <= $page; $i++) {
            $response = Http::get($baseUrl . '/species', [
                'page' => $i
            ])->throw()->object();

            $species = $species->merge($response->results);
        }

        $species
            ->each(function ($kind) {
                $species = $this->speciesRepository->firstOrCreate(
                    [
                        'name' => $kind->name,
                        'classification' => $kind->classification,
                        'designation' => $kind->designation,
                        'average_height' => $kind->average_height,
                        'skin_colors' => $kind->skin_colors,
                        'hair_colors' => $kind->hair_colors,
                        'eye_colors' => $kind->eye_colors,
                        'average_lifespan' => $kind->average_lifespan,
                        'language' => $kind->language,
                    ]
                );

                foreach ($kind->people as $people) {
                    FetchPeoplesJob::dispatch(
                        $people,
                        $species,
                        $this->peopleRepository
                    )->onQueue('fetch-people');
                }
            });
        return Command::SUCCESS;
    }
}
