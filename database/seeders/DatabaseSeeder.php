<?php

namespace NovaContracts\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Zareismail\NovaContracts\Models\User::factory(10)->create();
    }
}
