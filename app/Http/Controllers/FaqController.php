<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection<int, Faq>|LengthAwarePaginator<Faq>
     */
    public function index(): Collection|LengthAwarePaginator
    {
        return QueryBuilder::for(Faq::class)
            ->allowedFilters([
                'question',
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request): Faq
    {
        return Faq::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, Faq $faq): Faq
    {
        $faq->update($request->validated());

        return $faq->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq): bool
    {
        return $faq->delete() ?? false;
    }
}
