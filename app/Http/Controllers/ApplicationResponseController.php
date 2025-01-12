<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationResponse\StoreRequest;
use App\Http\Requests\ApplicationResponse\UpdateRequest;
use App\Http\Resources\ApplicationResponseResource;
use App\Models\ApplicationResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ApplicationResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $applicationResponse = QueryBuilder::for(ApplicationResponse::class)
            ->allowedFilters([
                'question',
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();

        return ApplicationResponseResource::collection($applicationResponse);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): ApplicationResponseResource
    {
        return new ApplicationResponseResource(ApplicationResponse::create($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ApplicationResponse $applicationResponse): ApplicationResponseResource
    {
        $applicationResponse->update($request->validated());

        return new ApplicationResponseResource($applicationResponse->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicationResponse $applicationResponse): bool
    {
        return $applicationResponse->delete() ?? false;
    }
}
