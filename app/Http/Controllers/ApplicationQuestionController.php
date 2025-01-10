<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationQuestion\StoreRequest;
use App\Http\Requests\ApplicationQuestion\UpdateRequest;
use App\Models\ApplicationQuestion;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ApplicationQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection<int, ApplicationQuestion>|LengthAwarePaginator<ApplicationQuestion>
     */
    public function index(): Collection|LengthAwarePaginator
    {
        return QueryBuilder::for(ApplicationQuestion::class)
            ->defaultSort('order')
            ->allowedSorts('order')
            ->allowedFilters([
                AllowedFilter::exact('is_active'),
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): ApplicationQuestion
    {
        return ApplicationQuestion::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ApplicationQuestion $applicationQuestion): ApplicationQuestion
    {
        $applicationQuestion->update($request->validated());

        return $applicationQuestion->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicationQuestion $applicationQuestion): bool
    {
        return $applicationQuestion->delete() ?? false;
    }
}
