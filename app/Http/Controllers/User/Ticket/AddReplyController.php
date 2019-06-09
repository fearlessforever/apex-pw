<?php

namespace App\Http\Controllers\User\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketReplyRequest;
use App\Ticket;

class AddReplyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(TicketReplyRequest $request, Ticket $ticket)
    {
        if ($ticket->isClosed()) {
            abort(403, __('app.tickets.cant_reply'));
        }

        $reply = $ticket->addReply([
            'message' => $request->message,
            'user_id' => $request->user()->ID
        ]);

        $ticket->status_id = Ticket::STATUS_WAITING_STAFF;
        $ticket->save();

        flash(__('app.tickets.reply'), 'success');

        return redirect()->route('tickets.show', ['id' => $ticket->id]);
    }
}
