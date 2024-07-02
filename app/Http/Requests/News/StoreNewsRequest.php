<?php

namespace App\Http\Requests\News;

use App\Dtos\News\NewsData;
use App\Enums\NewsStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreNewsRequest",
 *     type="object",
 *     title="Store News Request",
 *     required={"title", "url", "short_description", "full_description", "status"},
 *     @OA\Property(
 *         property="title",
 *         type="object",
 *         @OA\Property(property="en", type="string", example="Sample Title EN"),
 *         @OA\Property(property="uk", type="string", example="Sample Title UK")
 *     ),
 *     @OA\Property(
 *         property="short_description",
 *         type="object",
 *         @OA\Property(property="en", type="string", example="Sample short description EN"),
 *         @OA\Property(property="uk", type="string", example="Sample short description UK")
 *     ),
 *     @OA\Property(
 *         property="full_description",
 *         type="object",
 *         @OA\Property(property="en", type="string", example="Sample full description EN"),
 *         @OA\Property(property="uk", type="string", example="Sample full description UK")
 *     ),
 *     @OA\Property(property="url", type="string", example="http://example.com/news"),
 *     @OA\Property(property="status", type="string", example="active")
 * )
 */
class StoreNewsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|array',
            'title.*' => 'required|string',
            'url' => 'required|string',
            'short_description' => 'required|array',
            'short_description.*' => 'required|string',
            'full_description' => 'required|array',
            'full_description.*' => 'required|string',
            'status' => 'required|integer|in:' . implode(',', NewsStatusEnum::asArray()),
        ];
    }

    public function getDto(): NewsData
    {
        return NewsData::from($this->validated());
    }
}
