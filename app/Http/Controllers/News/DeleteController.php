<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Repositories\News\NewsRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Delete(
 *     path="/api/v1/news/{news}",
 *     operationId="deleteNews",
 *     tags={"News"},
 *     summary="Delete a news item",
 *     @OA\Parameter(
 *         name="news",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean")
 *         )
 *     )
 * )
 */
class DeleteController extends Controller
{
    public function __construct(protected NewsRepository $newsRepository)
    {
    }

    public function __invoke(News $news): JsonResponse
    {
        $this->newsRepository->delete($news);

        return response()->json([
            'success' => true,
        ], Response::HTTP_NO_CONTENT);
    }
}
