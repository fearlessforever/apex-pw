@extends('layouts.app')

@section('content')
<div class="w-full max-w-screen mx-auto px-4 flex py-8">
    @include('profile.nav')    
    <div class="flex-1">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h2 class="text-black font-bold text-xl mb-2">{{ __('app.change_password') }}</h2>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="current_password" class="block mb-3 text-90">{{ __('app.current_password') }}</label>
                        <input id="current_password" type="password" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
                        rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('current_password') ? ' border-red' : '' }}" 
                            name="current_password" value="{{ auth()->user()->current_password }}" autofocus>
                        @if ($errors->has('current_password'))
                            <p class="text-red text-xs italic pt-2" role="alert">
                                <strong>{{ $errors->first('current_password') }}</strong>
                            </p>
                        @endif
                    </div>
                    <!-- New Password -->
                    <div class="mb-4">
                        <label for="password" class="block mb-3 text-90">{{ __('app.new_password') }}</label>
                        <input id="password" type="password" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
                        rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('password') ? ' border-red' : '' }}" 
                            name="password" value="{{ auth()->user()->password }}" autofocus>
                        @if ($errors->has('password'))
                            <p class="text-red text-xs italic pt-2" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button class="bg-black hover:bg-grey-darkest text-white font-bold h-12 py-2 px-4 rounded">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection