<?php

namespace Database\Seeders;

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
        $this->call(UserSeeder::class);
        $this->call(IndustrySeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(TermSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(AnnualAndOneTimeSeeder::class);

    }
}
