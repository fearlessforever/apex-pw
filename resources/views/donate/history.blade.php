@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('donate.store') }}">
@csrf
<div class="card">
    <div class="card-header">
        <h2>{{ __('app.donate.history') }}</h2>
    </div>
    <div class="card-body">
        @include('flash::message')
    </div>
    <div class="card-body p-0">
        <table class="table">
            <thead>
                <tr>
                    <th class="px-2 pl-8 text-left">ID</th>
                    <th class="px-2 text-center">{{ __('app.donate.money', ['money' => config('money.currency')]) }} </th>
                    <th class="px-2 text-center">{{ __('app.donate.cash') }}</th>
                    <th class="px-2 text-center">Status</th>
                    <th class="px-2 text-center">Forma de Pagamento</th>
                    <th class="px-2 text-center">{{ __('app.donate.created_at') }}</th>
                    <th class="px-2 text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $donate)
                <tr>
                    <td class="py-4 pl-8 w-auto whitespace-no-wrap">{{ $donate->id }}</td>
                    <td class="text-center">{{ money($donate->package->price * 100) }}</td>
                    <td class="text-center">{{ $donate->package->cash }}</td>
                    <td class="text-center">
                        <span class="badge badge-{{ $donate->present()->status()['color'] }}">
                            {{ $donate->present()->status()['label'] }}
                        </span>
                    </td>
                    <td class="text-center">{{ $donate->gateway->name }}</td>
                    <td class="text-center whitespace-no-wrap">{{ $donate->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-center whitespace-no-wrap">
                        @if($donate->transaction_status == 'initiated')
                        <a href="{{ $donate->data['paymentUrl'] }}" target="_blank" class="bg-black shadow text-sm p-2 rounded text-white no-underline">
                            Pagar
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</form>
@endsection