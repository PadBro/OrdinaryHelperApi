<?php

namespace App\Http\Controllers;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Rule;
use App\Http\Requests\StoreRuleRequest;
use App\Http\Requests\UpdateRuleRequest;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QueryBuilder::for(Rule::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRuleRequest $request)
    {
        return Rule::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRuleRequest $request, Rule $rule)
    {
        $rule->update($request->validated());
        return $rule->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rule $rule)
    {
        return $rule->delete();
    }
}
