<?php

namespace App\Http\Resources\News;

use App\Enums\NewsStatusEnum;
use App\Models\News\News;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="NewsResource",
 *     type="object",
 *     title="News Resource",
 *     properties={
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="title", type="object",
 *             @OA\Property(property="en", type="string", example="Sample Title EN"),
 *             @OA\Property(property="uk", type="string", example="Sample Title UK")
 *         ),
 *         @OA\Property(property="url", type="string", example="http://example.com/news"),
 *         @OA\Property(property="short_description", type="object",
 *             @OA\Property(property="en", type="string", example="Sample short description EN"),
 *             @OA\Property(property="uk", type="string", example="Sample short description UK")
 *         ),
 *         @OA\Property(property="full_description", type="object",
 *             @OA\Property(property="en", type="string", example="Sample full description EN"),
 *             @OA\Property(property="uk", type="string", example="Sample full description UK")
 *         ),
 *         @OA\Property(property="created_at", type="string", format="date-time", example="2024-07-02T16:53:30.000000Z"),
 *         @OA\Property(property="status", type="string", example="active"),
 *         @OA\Property(property="status_name", type="string", example="Active")
 *     }
 * )
 *
 * @mixin News
 */
class NewsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'short_description' => $this->short_description,
            'full_description' => $this->full_description,
            'created_at' => $this->created_at,
            'status' => $this->status->value,
            'status_name' => $this->status->description,
        ];
    }
}
