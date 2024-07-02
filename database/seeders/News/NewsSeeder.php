<?php

namespace Database\Seeders\News;

use App\Models\News\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::factory(10)->create();
    }
}
