<?php

namespace App\Http\Controllers;

use App\Http\Requests\VanityRole\StoreRequest;
use App\Http\Requests\VanityRole\UpdateRequest;
use App\Models\VanityRole;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class VanityRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection<int, VanityRole>|LengthAwarePaginator<VanityRole>
     */
    public function index(): Collection|LengthAwarePaginator
    {
        return QueryBuilder::for(VanityRole::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('vanity_url_code'),
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): VanityRole
    {
        return VanityRole::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, VanityRole $vanityRole): VanityRole
    {
        $vanityRole->update($request->validated());

        return $vanityRole->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VanityRole $vanityRole): bool
    {
        return $vanityRole->delete() ?? false;
    }
}
