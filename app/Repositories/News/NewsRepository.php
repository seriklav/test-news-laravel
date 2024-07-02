<?php

namespace App\Repositories\News;

use App\Dtos\News\NewsData;
use App\Models\News\News;

class NewsRepository
{
    public function create(NewsData $dto): News
    {
        $news = News::create([
            'url' => $dto->url,
            'status' => $dto->status,
        ]);

        $this->setTranslations($news, $dto);

        return $news;
    }

    public function update(News $news, NewsData $dto): News
    {
        $data = array_filter([
            'url' => $dto->url,
            'status' => $dto->status,
        ]);

        $news->update($data);

        $this->setTranslations($news, $dto);

        return $news->refresh();
    }

    public function delete(News $news): void
    {
        $news->delete();
    }

    protected function setTranslations(News $news, NewsData $dto): void
    {
        foreach ($dto->title as $locale => $title) {
            $news->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title' => $title,
                    'short_description' => $dto->short_description[$locale] ?? '',
                    'full_description' => $dto->full_description[$locale] ?? '',
                ]
            );
        }
    }
}
