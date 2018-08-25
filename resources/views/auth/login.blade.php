@extends('layouts.app')

@section('content')
<div class="mt-3 md:mt-12 mx-auto bg-white shadow rounded-lg  py-8 px-12 max-w-sm">
<h1 class="text-2xl font-normal mb-6 uppercase text-center">{{ __('Login') }}</h1>
<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
    @csrf
    <div class="mb-8">
        <label for="name" class="block mb-3 text-90">{{ __('Login') }}</label>
            <input id="name" type="text" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
            rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('name') ? ' border-red' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <p class="text-red text-xs italic pt-2" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </p>
            @endif
    </div>

    <div class="mb-8">
        <label for="passwd" class="block mb-3 text-90">{{ __('Password') }}</label>
            <input id="passwd" type="password" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
            rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('passwd') ? ' border-red' : '' }}" name="passwd" required>
            @if ($errors->has('passwd'))
                <p class="text-red text-xs italic pt-2" role="alert">
                    <strong>{{ $errors->first('passwd') }}</strong>
                </p>
            @endif
    </div>

    <div class="mb-6">
        <div>
            <div>
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row items-center">
        <button type="submit" class="bg-black hover:bg-grey-darkest text-white font-bold h-12 py-2 px-4 rounded">
            {{ __('Login') }}
        </button>

        <a class="md:ml-auto text-primary no-underline dim" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    </div>
</form>
</div>
@endsection
