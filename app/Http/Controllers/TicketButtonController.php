<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketButton\StoreRequest;
use App\Http\Requests\TicketButton\UpdateRequest;
use App\Http\Resources\TicketButtonResource;
use App\Models\TicketButton;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TicketButtonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        if (! request()->user()?->can('ticketButton.read')) {
            abort(403);
        }
        $ticketButtons = QueryBuilder::for(TicketButton::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('ticket_panel_id'),
                AllowedFilter::exact('ticket_team_id'),
            ])
            ->getOrPaginate();

        return TicketButtonResource::collection($ticketButtons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): TicketButtonResource
    {
        return new TicketButtonResource(TicketButton::create($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, TicketButton $button): TicketButtonResource
    {
        $button->update($request->validated());

        return new TicketButtonResource($button);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketButton $button): bool
    {
        if (! request()->user()?->can('ticketButton.delete')) {
            abort(403);
        }

        return $button->delete() ?? false;
    }
}
