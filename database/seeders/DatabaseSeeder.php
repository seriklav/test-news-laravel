<?php

namespace Database\Seeders;

use Database\Seeders\News\NewsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(NewsSeeder::class);
    }
}
