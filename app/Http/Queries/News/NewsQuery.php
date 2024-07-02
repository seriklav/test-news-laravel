<?php

namespace App\Http\Queries\News;

use App\Http\Queries\BaseQuery;
use App\Models\News\News;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder as BuilderContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class ProposalQuery
 *
 * @package App\Queries
 */
class NewsQuery extends BaseQuery
{

	protected string $modelName = News::class;

    /**
     * @throws Exception
     */
    public function getModelWithRelation(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model()->with([
            'translations'
        ]);
    }

	/**
	 * @throws Exception
	 */
	public function getModelById(int $id): Model|Collection|BuilderContract|array|null
	{
        return $this
			->model()
			->newQuery()
			->findOrFail($id);
    }
}
