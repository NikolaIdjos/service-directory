<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\IndexProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ProviderController extends Controller
{
    public function index(IndexProviderRequest $request): JsonResponse
    {
        // Add cache for simulation
        $cacheKey = 'api_cache_providers_'.
            json_encode(
                [
                    'category_id' => $request->get('category_id', ''),
                    'page' => $request->get('page', 1),
                ]
        );
        $categoryId = $request->get('category_id');
        $providersData = Cache::remember(
            $cacheKey,
            300,
            function () use ($categoryId): array {
                $providers = Provider::with('category')
                    ->when($categoryId, function ($query) use ($categoryId) {
                        return $query->where('category_id', $categoryId);
                    })
                    ->paginate(12);

                return ProviderResource::collection($providers)->response()->getData(true);
            }
        );

        return response()->json($providersData);
    }

    public function show(Provider $provider): JsonResponse
    {
        return response()->json(
            new ProviderResource($provider->load('category'))
        );
    }
}
