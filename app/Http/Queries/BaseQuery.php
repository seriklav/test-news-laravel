<?php

namespace App\Http\Queries;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\ForwardsCalls;


abstract class BaseQuery
{
	use ForwardsCalls;

	protected string $modelName;
	private Model $model;

	/**
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		if (! $this->modelName) {
			throw new Exception('Model classname is not defined!');
		}

		$this->model = resolve($this->modelName);
	}

	/**
	 *
	 * @return Model
	 * @throws Exception
	 */
	public function model(): Model
	{
		return $this->model;
	}

	/***
	 * @param string $method
	 * @param array $parameters
	 * @return mixed
	 */
	public function __call(string $method, array $parameters)
	{
		return $this->forwardCallTo($this->model::query(), $method, $parameters);
	}
}
