<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use App\Ticket;
use App\User;
use App\Traits\PerfectWorld;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;

class TicketTest extends TestCase
{

    use WithFaker, PerfectWorld;

    /**
     * Test if user can create a new ticket.
     *
     * @return void
     */
    public function testUserCanCreateATicket()
    {
        $user = $this->create([
            'name' => $this->faker()->username,
            'passwd' => Hash::make('password'),
            'truename' => $this->faker()->name,
            'email' => $this->faker()->unique()->safeEmail
        ]);

        $this->actingAs($user)
            ->post(route('tickets.store'), [
                'category_id' => 1,
                'subject' => 'Ticket subject',
                'message' => 'Dummy ticket.',
                'closed_at' => now(),
            ])
            ->assertRedirect(route('tickets.index'))
            ->assertSessionHas('laravel_flash_message.message', __('app.tickets.created'));
    }

    /**
     * Test if user can view a specific ticket.
     *
     * @return void
     */
    public function testUserCanViewATicket()
    {
        $user = $this->create([
            'name' => $this->faker()->username,
            'passwd' => Hash::make('password'),
            'truename' => $this->faker()->name,
            'email' => $this->faker()->unique()->safeEmail
        ]);
        $ticket = $user->tickets()->create(factory(Ticket::class)->make()->toArray());

        $this->actingAs($user)
            ->get(route('tickets.show', ['id' => $ticket->id]))
            ->assertViewIs('tickets.show')
            ->assertViewHas('ticket')
            ->assertSee($ticket->subject);
    }

    /**
     * Test if user can't see a ticket if he is not the owner.
     *
     * @return void
     */
    public function testUserCannotSeeTicketIfHeIsNotTheOwner()
    {
        $user = $this->create([
            'name' => $this->faker()->username,
            'passwd' => Hash::make('password'),
            'truename' => $this->faker()->name,
            'email' => $this->faker()->unique()->safeEmail
        ]);

        $shapeshifter = $this->create([
            'name' => $this->faker()->username,
            'passwd' => Hash::make('password'),
            'truename' => $this->faker()->name,
            'email' => $this->faker()->unique()->safeEmail
        ]);

        $ticket = $user->tickets()->create(factory(Ticket::class)->make()->toArray());

        $this->actingAs($shapeshifter)
            ->get(route('tickets.show', ['id' => $ticket->id]))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Test if user can see all tickets in index page.
     *
     * @return void
     */
    public function testUserCanSeeAllTickets()
    {
        $user = $this->create([
            'name' => $this->faker()->username,
            'passwd' => Hash::make('password'),
            'truename' => $this->faker()->name,
            'email' => $this->faker()->unique()->safeEmail
        ]);

        $user->tickets()->create(factory(Ticket::class)->make()->toArray());

        $tickets = $user->tickets()->latest()->paginate(10);

        $this->actingAs($user)
            ->get(route('tickets.index'))
            ->assertViewIs('tickets.index')
            ->assertViewHas('tickets')
            ->assertSee($tickets->first()->subject);
    }

    /**
     * User can mark a ticket as solved.
     *
     * @return void
     */
    public function testUserCanMarkTicketAsSolved()
    {
        $user = $this->create([
            'name' => $this->faker()->username,
            'passwd' => Hash::make('password'),
            'truename' => $this->faker()->name,
            'email' => $this->faker()->unique()->safeEmail
        ]);
        $ticket = $user->tickets()->create(factory(Ticket::class)->make()->toArray());

        $this->actingAs($user)
            ->delete(route('tickets.destroy', ['id' => $ticket->id]))
            ->assertRedirect(route('tickets.show', ['id' => $ticket->id]))
            ->assertSessionHas('laravel_flash_message.message', __('app.tickets.mark_as_solved'));
    }


    /**
     * Uer can't add reply to a ticket that was previously
     * mark as solved.
     *
     * @return void
     */
    public function testUserCannotAddReplyToClosedTicket()
    {
        $user = $this->create([
            'name' => $this->faker()->username,
            'passwd' => Hash::make('password'),
            'truename' => $this->faker()->name,
            'email' => $this->faker()->unique()->safeEmail
        ]);

        $ticket = $user->tickets()->create([
            'category_id' => 1,
            'subject' => 'Ticket subject',
            'message' => 'Dummy ticket.',
            'closed_at' => now(),
        ]);

        $this->actingAs($user)
            ->post("ticket/{$ticket->id}/reply", ['message' => 'Some random reply.'])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
