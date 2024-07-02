<?php

namespace App\Http\Requests\News;

use App\Dtos\News\NewsData;
use App\Enums\NewsStatusEnum;
use App\Models\News\News;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

/**
 * @OA\Schema(
 *     schema="UpdateNewsRequest",
 *     type="object",
 *     title="Update News Request",
 *     @OA\Property(
 *         property="title",
 *         type="object",
 *         @OA\Property(property="en", type="string", example="Updated Title EN"),
 *         @OA\Property(property="uk", type="string", example="Updated Title UK")
 *     ),
 *     @OA\Property(
 *         property="short_description",
 *         type="object",
 *         @OA\Property(property="en", type="string", example="Updated short description EN"),
 *         @OA\Property(property="uk", type="string", example="Updated short description UK")
 *     ),
 *     @OA\Property(
 *         property="full_description",
 *         type="object",
 *         @OA\Property(property="en", type="string", example="Updated full description EN"),
 *         @OA\Property(property="uk", type="string", example="Updated full description UK")
 *     ),
 *     @OA\Property(property="url", type="string", example="http://example.com/news"),
 *     @OA\Property(property="status", type="string", example="hidden")
 * )
 */
class UpdateNewsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'sometimes|array',
            'title.*' => 'sometimes|string',
            'url' => 'sometimes|string',
            'short_description' => 'sometimes|array',
            'short_description.*' => 'sometimes|string',
            'full_description' => 'sometimes|array',
            'full_description.*' => 'sometimes|string',
            'status' => 'sometimes|integer|in:' . implode(',', NewsStatusEnum::asArray()),
        ];
    }

    public function getDto(News $news): NewsData
    {
        $validated = $this->validated();

        return NewsData::from([
            'title' => array_merge($news->translations->pluck('title', 'locale')->toArray(), Arr::get($validated, 'title', [])),
            'url' => Arr::get($validated, 'url', $news->url),
            'short_description' => array_merge($news->translations->pluck('short_description', 'locale')->toArray(), Arr::get($validated, 'short_description', [])),
            'full_description' => array_merge($news->translations->pluck('full_description', 'locale')->toArray(), Arr::get($validated, 'full_description', [])),
            'status' => Arr::get($validated, 'status', $news->status),
        ]);
    }
}
