<?php

use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('medialibrary:clean', ['--force' => true]);
        Artisan::call('medialibrary:clear', ['--force' => true]);
    }
}
