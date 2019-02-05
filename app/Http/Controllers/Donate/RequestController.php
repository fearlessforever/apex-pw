<?php

namespace App\Http\Controllers\Donate;

use App\Http\Controllers\Controller;
use App\CashPackage;
use App\PaymentGateway;
use App\Donate;
use App\Http\Requests\DonateRequest;
use Illuminate\Support\Str;
use App\Contracts\Repositories\UserRepository;

class RequestController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    /**
     * Shows the donate request page
     */
    public function index()
    {
        $packages = CashPackage::all();
        $gateways = PaymentGateway::byEnabled()->get();

        return view('donate.index', compact('packages', 'gateways'));
    }

    /**
     * Store the newly created order
     */
    public function store(DonateRequest $request)
    {
        $order = $this->user->current()->orders()->create([
            'package_id' => $request->cash_package,
            'gateway_id' => $request->gateway,
            'transaction_reference' => Str::uuid()
        ]);

        // Get payment gateway
        $gateway = PaymentGateway::find($order->gateway_id);

        // Create and retrieves the paymentUrl from the given payment gateway
        $paymentUrl = $gateway->payment()->create($order);

        // Saves the paymentUrl
        $order->data = collect($order->data)->put('paymentUrl', $paymentUrl);
        $order->save();

        flash('Pedido criado com sucesso')->success();

        return redirect()->route('donate.history');
    }
}
