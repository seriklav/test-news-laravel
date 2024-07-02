<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\News\NewsResource;
use App\Models\News\News;

/**
 * @OA\Get(
 *     path="/api/v1/news/{news}",
 *     operationId="getNewsShow",
 *     tags={"News"},
 *     summary="Get one news by id",
 *     @OA\Parameter(
 *          name="news",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/NewsResourceCollection")
 *     )
 * )
 */
class ShowController extends Controller
{
    public function __invoke(News $news): NewsResource
    {
        return resolve(NewsResource::class, ['resource' => $news]);
    }
}
