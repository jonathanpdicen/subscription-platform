<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Subscriber\SubscribeRequest;
use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Http\JsonResponse;

class SubscriberController extends Controller
{
    public function __invoke(Website $website, SubscribeRequest $request): JsonResponse
    {
        $website->subscribers()->save(
            new Subscriber($request->validated())
        );

        return response()->json(['message' => 'Subscribed successfully'], 200);
    }
}
