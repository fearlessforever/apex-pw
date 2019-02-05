@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('donate.store') }}">
@csrf
<div class="card">
    <div class="card-header">
        <h2>{{ __('app.donate.request') }}</h2>
    </div>
    <div class="card-body">
        @include('partials.errors')
        <!-- Package -->
        @if(! empty($packages))
        <div class="mb-4">
            <label for="packages" class="block mb-3 text-90">{{ __('app.donate.lblPackage') }}</label>
            <select name="cash_package" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
                        rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('cash_package') ? ' border-red' : '' }}">
                @foreach($packages as $package)
                <option value="{{ $package->id }}">Pacote {{ money($package->price * 100) }} ({{  $package->cash }} GOLDs)</option>
                @endforeach
            </select>
            @if ($errors->has('cash_package'))
                <p class="text-red text-xs italic pt-2" role="alert">
                    <strong>{{ $errors->first('cash_package') }}</strong>
                </p>
            @endif
        </div>
        @else
        <div class="alert alert-danger">
            {{ __('app.donate.emptyPackage') }}
        </div>
        @endif
        <!-- Gateway -->
        @if(! empty($gateways))
        <div class="mb-4">
            <label for="packages" class="block mb-3 text-90">{{ __('app.donate.lblGateways') }}</label>
            <select name="gateway" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
                        rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('gateway') ? ' border-red' : '' }}">
                @foreach($gateways as $gateway)
                <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('gateway'))
                <p class="text-red text-xs italic pt-2" role="alert">
                    <strong>{{ $errors->first('gateway') }}</strong>
                </p>
            @endif
        </div>
        @else
        <div class="alert alert-danger">
            {{ __('app.donate.emptyGateways') }}
        </div>
        @endif
    </div>
    <div class="card-footer">
        <button class="bg-black hover:bg-grey-darkest text-white font-bold h-12 py-2 px-4 rounded">
            Confirm
        </button>
    </div>
</div>
</form>
@endsection