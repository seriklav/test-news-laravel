<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\News\NewsResourceCollection;
use App\Http\Search\News\NewsSearch;
use Exception;

/**
 * @OA\Get(
 *     path="/api/v1/news",
 *     operationId="getNewsList",
 *     tags={"News"},
 *     summary="Get list of news",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/NewsResourceCollection")
 *     )
 * )
 */
class IndexController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(NewsSearch $search): NewsResourceCollection
    {
        $news = $search->search()->paginate();

        return resolve(NewsResourceCollection::class, ['resource' => $news]);
    }
}
