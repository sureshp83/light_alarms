<?php

namespace App\Console\Commands;

use App\Models\NewProduct;
use Illuminate\Console\Command;

class SearchIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create :name Search index';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->description = 'Create '.config('app.name').' Search index';

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('tntsearch:import', ['model' => NewProduct::class]);

        $this->info("Search index has been created.");
    }
}
