<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationResponse\StoreRequest;
use App\Http\Requests\ApplicationResponse\UpdateRequest;
use App\Models\ApplicationResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ApplicationResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection<int, ApplicationResponse>|LengthAwarePaginator<ApplicationResponse>
     */
    public function index(): Collection|LengthAwarePaginator
    {
        return QueryBuilder::for(ApplicationResponse::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): ApplicationResponse
    {
        return ApplicationResponse::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ApplicationResponse $applicationResponse): ApplicationResponse
    {
        $applicationResponse->update($request->validated());

        return $applicationResponse->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicationResponse $applicationResponse): bool
    {
        return $applicationResponse->delete() ?? false;
    }
}
