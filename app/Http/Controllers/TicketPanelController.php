<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketPanel\StoreRequest;
use App\Http\Requests\TicketPanel\UpdateRequest;
use App\Http\Resources\TicketPanelResource;
use App\Models\TicketPanel;
use App\Repositories\TicketPanelRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TicketPanelController extends Controller
{
    public function __construct(
        protected TicketPanelRepository $ticketPanelRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        if (! request()->user()?->can('ticketPanel.read')) {
            abort(403);
        }
        $ticketPanels = QueryBuilder::for(TicketPanel::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();

        return TicketPanelResource::collection($ticketPanels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): TicketPanelResource
    {
        return new TicketPanelResource(TicketPanel::create($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, TicketPanel $panel): TicketPanelResource
    {
        $panel->update($request->validated());

        return new TicketPanelResource($panel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketPanel $panel): bool
    {
        if (! request()->user()?->can('ticketPanel.delete')) {
            abort(403);
        }

        return $panel->delete() ?? false;
    }

    public function send(TicketPanel $panel): bool
    {
        return $this->ticketPanelRepository->sendPanel($panel);
    }
}
