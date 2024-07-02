<?php

namespace Database\Factories\News;

use App\Enums\NewsStatusEnum;
use App\Models\News\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<News>
 */
class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        return [
            'url' => $this->faker->url,
            'status' => NewsStatusEnum::getRandomValue(),
        ];
    }

    public function configure(): NewsFactory|Factory
    {
        return $this->afterCreating(fn (News $news) =>
            $news->translations()->createMany([
                [
                    'locale' => 'en',
                    'title' => $this->faker->sentence,
                    'short_description' => $this->faker->paragraph,
                    'full_description' => $this->faker->text,
                ],
                [
                    'locale' => 'uk',
                    'title' => $this->faker->sentence,
                    'short_description' => $this->faker->paragraph,
                    'full_description' => $this->faker->text,
                ]
            ])
        );
    }
}
