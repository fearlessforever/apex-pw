<?php

namespace App\Http\Controllers\Donate;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\UserRepository;

class DonateController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Shows user's latest orders.
     */
    public function index()
    {
        $orders = $this->user->current()->orders()->latest()->paginate(10);

        return view('donate.history', compact('orders'));
    }
}
