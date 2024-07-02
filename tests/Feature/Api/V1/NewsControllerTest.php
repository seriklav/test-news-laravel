<?php

namespace Tests\Feature\Api\V1;

use App\Models\News\News;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Enums\NewsStatusEnum;

class NewsControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_can_list_news(): void
    {
        News::factory(10)->create();

        $response = $this->getJson('/api/v1/news');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'url',
                        'short_description',
                        'full_description',
                        'created_at',
                        'status',
                        'status_name',
                    ]
                ]
            ]);
    }

    public function test_it_can_create_news(): void
    {
        $data = [
            'title' => ['en' => 'Sample Title EN', 'uk' => 'Sample Title UK'],
            'url' => 'http://example.com/news',
            'short_description' => ['en' => 'Sample short description EN', 'uk' => 'Sample short description UK'],
            'full_description' => ['en' => 'Sample full description EN', 'uk' => 'Sample full description UK'],
            'status' => NewsStatusEnum::ACTIVE,
        ];

        $response = $this->postJson('/api/v1/news', $data);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'id' => $response->json('data.id'),
                    'title' => $data['title']['en'],
                    'url' => $data['url'],
                    'short_description' => $data['short_description']['en'],
                    'full_description' => $data['full_description']['en'],
                    'created_at' => $response->json('data.created_at'),
                    'status' => $data['status'],
                    'status_name' => NewsStatusEnum::getDescription($data['status']),
                ]
            ]);

        $this->assertDatabaseHas('news', ['url' => $data['url']]);
        foreach ($data['title'] as $locale => $title) {
            $this->assertDatabaseHas('news_translations', ['title' => $title, 'locale' => $locale]);
        }
    }

    public function test_it_can_show_news(): void
    {
        $news = News::factory()->create();

        $response = $this->getJson(
            sprintf("/api/v1/news/%d", $news->id)
        );

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $news->id,
                    'title' => $news->title,
                    'url' => $news->url,
                    'short_description' => $news->short_description,
                    'full_description' => $news->full_description,
                    'created_at' => $news->created_at->toISOString(),
                    'status' => $news->status->value,
                    'status_name' => $news->status->description,
                ]
            ]);
    }

    public function test_it_can_update_news(): void
    {
        $news = News::factory()->create();

        $data = [
            'title' => ['en' => 'Updated Title EN', 'uk' => 'Updated Title UK'],
            'url' => 'http://example.com/updated-news',
            'short_description' => ['en' => 'Updated short description EN', 'uk' => 'Updated short description UK'],
            'full_description' => ['en' => 'Updated full description EN', 'uk' => 'Updated full description UK'],
            'status' => NewsStatusEnum::ACTIVE,
        ];

        $response = $this->patchJson(
            sprintf("/api/v1/news/%d", $news->id),
            $data
        );

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $news->id,
                    'title' => $data['title']['en'],
                    'url' => $data['url'],
                    'short_description' => $data['short_description']['en'],
                    'full_description' => $data['full_description']['en'],
                    'created_at' => $news->created_at->toISOString(),
                    'status' => $data['status'],
                    'status_name' => NewsStatusEnum::getDescription($data['status']),
                ]
            ]);

        $this->assertDatabaseHas('news', ['url' => $data['url']]);
        foreach ($data['title'] as $locale => $title) {
            $this->assertDatabaseHas('news_translations', ['title' => $title, 'locale' => $locale]);
        }
        foreach ($data['short_description'] as $locale => $shortDescription) {
            $this->assertDatabaseHas('news_translations', ['short_description' => $shortDescription, 'locale' => $locale]);
        }
        foreach ($data['full_description'] as $locale => $fullDescription) {
            $this->assertDatabaseHas('news_translations', ['full_description' => $fullDescription, 'locale' => $locale]);
        }
    }

    public function test_it_can_delete_news()
    {
        $news = News::factory()->create();

        $response = $this->deleteJson("/api/v1/news/{$news->id}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('news', ['id' => $news->id]);
        $this->assertDatabaseMissing('news_translations', ['news_id' => $news->id]);
    }
}
