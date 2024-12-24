<?php

namespace App\Http\Controllers;

use App\Http\Requests\Application\StoreRequest;
use App\Http\Requests\Application\UpdateRequest;
use App\Models\Application;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection<int, Application>|LengthAwarePaginator<Application>
     */
    public function index(): Collection|LengthAwarePaginator
    {
        return QueryBuilder::for(Application::class)
            ->allowedFilters([
                'question',
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): Application
    {
        return Application::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Application $application): Application
    {
        $application->update($request->validated());

        return $application->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application): bool
    {
        return $application->delete() ?? false;
    }
}
