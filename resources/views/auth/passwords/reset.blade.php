@extends('layouts.app')

@section('content')
<div class="mt-3 md:mt-12 mx-auto bg-white shadow rounded-lg  py-8 px-12 max-w-sm">
    <h1 class="text-2xl font-normal mb-6 uppercase text-center">{{ __('Reset Password') }}</h1>
    <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-8">
            <label for="email" class="block mb-3 text-90">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
            rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('email') ? ' is-invalid' : '' }}"
                name="email" value="{{ $email ?? old('email') }}" required autofocus> @if ($errors->has('email'))
            <p class="text-red text-xs italic pt-2" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </p>
            @endif
        </div>

        <div class="mb-8">
            <label for="password" class="block mb-3 text-90">{{ __('Password') }}</label>
            <input id="password" type="password" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
            rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('password') ? ' is-invalid' : '' }}"
                name="password" required> @if ($errors->has('password'))
            <p class="text-red text-xs italic pt-2" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </p>
            @endif
        </div>

        <div class="mb-6">
            <label for="password-confirm" class="block mb-3 text-90">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
            rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black "
                name="password_confirmation" required>
        </div>

        <button type="submit" class="bg-black hover:bg-grey-darkest text-white font-bold h-12 py-2 px-4 rounded">
            {{ __('Reset Password') }}
        </button>
    </form>
</div>
@endsection
