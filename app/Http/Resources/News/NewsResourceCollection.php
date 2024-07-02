<?php

namespace App\Http\Resources\News;

use App\Http\Resources\BaseResourceCollection;

/**
 * @OA\Schema(
 *     schema="NewsResourceCollection",
 *     type="object",
 *     title="News Resource Collection",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/NewsResource")
 *     )
 * )
 */
class NewsResourceCollection extends BaseResourceCollection
{}
