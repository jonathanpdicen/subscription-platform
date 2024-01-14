<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\QueryBuilder;

abstract class ModelController extends Controller implements ModelControllerInterface
{
    public function respondIndex(Closure $beforeReturn = null): ResourceCollection
    {
        $query = $this->getIndexQuery();

        if ($beforeReturn) {
            $beforeReturn($query);
        }

        $collection = $this->shouldPaginate()
            ? $query->paginate($this->limit())
                ->appends(
                    request()->query()
                )
            : $query->get();


        $class = $this->resourceClass();
        return $class::collection($collection);
    }

    protected function limit(): int
    {
        return request('limit', 15);
    }

    protected function getIndexQuery(): QueryBuilder
    {
        return QueryBuilder::for($this->modelClass())
            ->allowedFilters($this->allowedFilters())
            ->allowedSorts($this->allowedSorts())
            ->defaultSorts($this->defaultSorts())
            ->allowedIncludes($this->allowedIncludes());
    }

    public function allowedFilters(): array
    {
        return [];
    }

    public function allowedSorts(): array
    {
        return [];
    }

    public function defaultSorts(): array
    {
        return [];
    }

    public function allowedIncludes(): array
    {
        return [];
    }

    public function resourceClass(): string
    {
        return $this->resourceNamespace() . '\\' . Arr::last(explode('\\', $this->modelClass()));
    }

    protected function resourceNamespace(): string
    {
        return 'App\\Http\\Resources\\V1';
    }

    public function shouldPaginate(): bool
    {
        return request('paginate', true);
    }

    protected function respondModel(Model|Builder $modelData, Closure $beforeReturn = null): JsonResource
    {
        /** @var Builder $baseQuery */
        $baseQuery = $modelData;

        if ($modelData instanceof Model) {
            $baseQuery = $modelData->newQuery();
        }

        $query = QueryBuilder::for($baseQuery)
            ->allowedIncludes(
                $this->allowedIncludes()
            );

        if ($beforeReturn) {
            $beforeReturn($query);
        }

        if ($modelData instanceof Model) {
            $query->where(
                $modelData->getKeyName(),
                $modelData->getKey()
            );
        }

        $class = $this->resourceClass();

        return new $class(
            $query->first()
        );
    }
}