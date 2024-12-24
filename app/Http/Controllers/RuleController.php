<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rule\StoreRequest;
use App\Http\Requests\Rule\UpdateRequest;
use App\Models\Rule;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection<int, Rule>|LengthAwarePaginator<Rule>
     */
    public function index(): Collection|LengthAwarePaginator
    {
        return QueryBuilder::for(Rule::class)
            ->defaultSort('number')
            ->allowedSorts('number')
            ->allowedFilters([
                'name',
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): Rule
    {
        return Rule::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Rule $rule): Rule
    {
        $rule->update($request->validated());

        return $rule->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rule $rule): bool
    {
        return $rule->delete() ?? false;
    }
}
