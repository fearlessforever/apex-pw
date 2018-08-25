@extends('layouts.app')

@section('content')
<div class="mt-3 md:mt-12 mx-auto bg-white shadow rounded-lg  py-8 px-12 max-w-sm">
    <h1 class="text-2xl font-normal mb-6 uppercase text-center">{{ __('Reset Password') }}</h1>

    @if (session('status'))
        <div class="bg-green-lightest border border-green-light text-green-dark px-4 py-3 mb-6 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
        @csrf

        <div class="mb-8">
            <label for="email" class="block mb-3 text-90">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
            rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <p class="text-red text-xs italic pt-2" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </p>
            @endif
        </div>

        <div class="mb-8">
            <button type="submit" class="bg-black hover:bg-grey-darkest text-white font-bold h-12 py-2 px-4 rounded">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>
</div>
@endsection
