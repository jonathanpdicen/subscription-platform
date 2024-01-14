<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ModelController;
use App\Http\Requests\V1\Website\StoreRequest;
use App\Http\Requests\V1\Website\UpdateRequest;
use App\Models\Website;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class WebsiteController extends ModelController
{
    public function modelClass(): string
    {
        return Website::class;
    }

    public function allowedIncludes(): array
    {
        return ['posts'];
    }

    public function index(): ResourceCollection
    {
        return $this->respondIndex();
    }

    public function store(StoreRequest $request): JsonResource
    {
        $website = DB::transaction(
            function () use ($request) {
                return Website::create($request->validated());
            }
        );

        return $this->respondModel($website);
    }

    public function show(Website $website): JsonResource
    {
        return $this->respondModel($website);
    }

    public function update(UpdateRequest $request, Website $website): JsonResource
    {
        $website = DB::transaction(
            function () use ($request, $website) {
                $website->update($request->validated());

                return $website;
            }
        );

        return $this->respondModel($website);
    }

    public function destroy(Website $website)
    {
        $website->delete();

        return response()->json(null, 204);
    }
}
