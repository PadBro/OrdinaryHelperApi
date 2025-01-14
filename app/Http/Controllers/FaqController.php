<?php

namespace App\Http\Controllers;

use App\Http\Requests\Faq\StoreRequest;
use App\Http\Requests\Faq\UpdateRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        if (! request()->user()?->can('faq.read')) {
            abort(403);
        }
        $faqs = QueryBuilder::for(Faq::class)
            ->allowedFilters([
                'question',
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();

        return FaqResource::collection($faqs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): FaqResource
    {
        return new FaqResource(Faq::create($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Faq $faq): FaqResource
    {
        $faq->update($request->validated());

        return new FaqResource($faq);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq): bool
    {
        if (! request()->user()?->can('faq.delete')) {
            abort(403);
        }

        return $faq->delete() ?? false;
    }
}
