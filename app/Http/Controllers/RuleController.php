<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rule\StoreRequest;
use App\Http\Requests\Rule\UpdateRequest;
use App\Http\Resources\RuleResource;
use App\Models\Rule;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $rules = QueryBuilder::for(Rule::class)
            ->defaultSort('number')
            ->allowedSorts('number')
            ->allowedFilters([
                'name',
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();

        return RuleResource::collection($rules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RuleResource
    {
        return new RuleResource(Rule::create($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Rule $rule): RuleResource
    {
        $rule->update($request->validated());

        return new RuleResource($rule->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rule $rule): bool
    {
        return $rule->delete() ?? false;
    }
}
