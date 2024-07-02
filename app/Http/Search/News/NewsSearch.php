<?php

namespace App\Http\Search\News;

use App\Http\Queries\News\NewsQuery;
use Exception;
use Spatie\QueryBuilder\QueryBuilder;

class NewsSearch
{
    public function __construct(protected NewsQuery $query)
    {
    }

    /**
     * @throws Exception
     */
    public function search(): QueryBuilder
    {
        return QueryBuilder::for($this->query->getModelWithRelation())
            ->allowedFilters(['status'])
            ->latest();
    }
}
