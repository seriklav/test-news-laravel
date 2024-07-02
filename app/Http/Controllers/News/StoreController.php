<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Resources\News\NewsResource;
use App\Repositories\News\NewsRepository;

/**
 * @OA\Post(
 *     path="/api/v1/news",
 *     operationId="storeNews",
 *     tags={"News"},
 *     summary="Store a new news item",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/StoreNewsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/NewsResource")
 *     )
 * )
 */
class StoreController extends Controller
{
    public function __construct(protected NewsRepository $newsRepository)
    {
    }

    public function __invoke(StoreNewsRequest $request): NewsResource
    {
        $dto = $request->getDto();

        $news = $this->newsRepository->create($dto);

        return resolve(NewsResource::class, ['resource' => $news]);
    }
}
