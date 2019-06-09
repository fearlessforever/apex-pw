<?php

namespace App\Http\Controllers\User\Ticket;

use App\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\TicketCategory;
use Illuminate\Support\Facades\Cache;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Ticket::class, 'ticket');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = auth()->user()->tickets()->latest()->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Cache::remember('tickets::categories', 3600, function () {
            return TicketCategory::all();
        });

        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
        $ticket = $request->user()->tickets()->create(
            $request->all()
        );

        flash(__('app.tickets.created'), 'success');

        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if ($ticket->isClosed()) {
            abort(403, __('app.tickets.cant_reply'));
        }

        $ticket->closed_at = now();
        $ticket->status_id = Ticket::STATUS_RESOLVED;
        $ticket->save();

        flash(__('app.tickets.mark_as_solved'), 'success');

        return redirect()->route('tickets.show', ['id' => $ticket->id]);
    }
}
