<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\IndexProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;

class ProviderController extends Controller
{
    public function index(IndexProviderRequest $request): JsonResponse
    {
        $categoryId = $request->input('category_id');
        $providers = Provider::with('category')
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->paginate(12);

        return response()->json(
            ProviderResource::collection($providers)->response()->getData(true)
        );
    }

    public function show(Provider $provider): JsonResponse
    {
        return response()->json(
            new ProviderResource($provider->load('category'))
        );
    }
}
