<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Resources\News\NewsResource;
use App\Models\News\News;
use App\Repositories\News\NewsRepository;

/**
 * @OA\Patch(
 *     path="/api/v1/news/{news}",
 *     operationId="updateNews",
 *     tags={"News"},
 *     summary="Update a news item",
 *     @OA\Parameter(
 *         name="news",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateNewsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/NewsResource")
 *     )
 * )
 */
class UpdateController extends Controller
{
    public function __construct(protected NewsRepository $newsRepository)
    {
    }

    public function __invoke(News $news, UpdateNewsRequest $request): NewsResource
    {
        $dto = $request->getDto($news);

        $news = $this->newsRepository->update($news, $dto);

        return resolve(NewsResource::class, ['resource' => $news]);
    }
}
