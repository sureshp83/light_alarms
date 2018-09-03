<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            AgenciesTableSeeder::class,
            UsersTableSeeder::class,
            MediaTableSeeder::class,

            ProductCategoriesTableSeeder::class,
            ProductTrainingVideosTableSeeder::class,
            NewProductsTableSeeder::class,
            // SalesToolsTableSeeder::class,
        ]);
    }
}
