<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationQuestionAnswer\StoreRequest;
use App\Http\Requests\ApplicationQuestionAnswer\UpdateRequest;
use App\Models\ApplicationQuestionAnswer;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ApplicationQuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection<int, ApplicationQuestionAnswer>|LengthAwarePaginator<ApplicationQuestionAnswer>
     */
    public function index(): Collection|LengthAwarePaginator
    {
        return QueryBuilder::for(ApplicationQuestionAnswer::class)
            ->allowedFilters([
                'question',
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): ApplicationQuestionAnswer
    {
        return ApplicationQuestionAnswer::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ApplicationQuestionAnswer $applicationQuestionAnswer): ApplicationQuestionAnswer
    {
        $applicationQuestionAnswer->update($request->validated());

        return $applicationQuestionAnswer->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicationQuestionAnswer $applicationQuestionAnswer): bool
    {
        return $applicationQuestionAnswer->delete() ?? false;
    }
}
