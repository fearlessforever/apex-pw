@extends('layouts.app')

@section('content')
<div class="w-full max-w-screen mx-auto px-4 flex py-8">
    @include('profile.nav')    
    <!-- Profile -->
    <div class="flex-1">
        <form method="POST" action="{{ route('profile.update') }}">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('app.my_profile') }}</h2>           
                </div>
                <!-- begin:: card-body -->
                <div class="card-body">
                    <span class="border-b border-30 mb-4"></span>
                    @include('flash::message')
                    @include('partials.errors')            
                    @csrf
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="truename" class="block mb-3 text-90">Name</label>
                        <input id="truename" type="text" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
                        rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('truename') ? ' border-red' : '' }}" 
                            name="truename" value="{{ auth()->user()->truename }}" autofocus>
                        @if ($errors->has('truename'))
                            <p class="text-red text-xs italic pt-2" role="alert">
                                <strong>{{ $errors->first('truename') }}</strong>
                            </p>
                        @endif
                    </div>
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block mb-3 text-90">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
                            rounded w-full py-2 opacity-75 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                name="email" value="{{ auth()->user()->email }}" readonly disabled>

                        @if ($errors->has('email'))
                            <p class="text-red text-xs italic pt-2" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>   
                <!-- end:: card-body -->       
                <div class="card-footer">
                    <button class="bg-black hover:bg-grey-darkest text-white font-bold h-12 py-2 px-4 rounded">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
