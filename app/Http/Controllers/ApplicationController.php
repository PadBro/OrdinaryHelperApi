<?php

namespace App\Http\Controllers;

use App\Http\Requests\Application\StoreRequest;
use App\Http\Requests\Application\UpdateRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $applications = QueryBuilder::for(Application::class)
            ->allowedFilters([
                'question',
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();

        return ApplicationResource::collection($applications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): ApplicationResource
    {
        return new ApplicationResource(Application::create($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Application $application): ApplicationResource
    {
        $application->update($request->validated());

        return new ApplicationResource($application->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application): bool
    {
        return $application->delete() ?? false;
    }
}
