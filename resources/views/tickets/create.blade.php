@extends('layouts.app')

@section('content')
<div class="w-full max-w-screen mx-auto px-4 flex py-8">
    @include('tickets.menu')
    <div class="flex-1">
        <form method="POST" action="{{ route('tickets.store') }}">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('app.tickets.new') }}</h2>
                </div>
                <!-- begin:: card-body -->
                <div class="card-body p-8">
                    <span class="border-b border-30 mb-4"></span>
                    @csrf
                    <!-- Category -->
                    <div class="mb-4">
                        <label for="categories" class="block mb-3 text-90">{{ __('app.tickets.categories') }}</label>
                        <select name="category_id" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
                                            rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black
                                            @error('category_id') border-red @enderror">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-red text-xs italic pt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <!-- Subject -->
                    <div class="mb-4">
                        <label for="subject" class="block mb-3 text-90">{{ __('app.tickets.subject') }}</label>
                        <input id="subject" type="text" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
                                    rounded w-full py-2 opacity-75 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black
                                    @error('subject') border-red @enderror" name="subject">

                        @error('subject')
                        <p class="text-red text-xs italic pt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <!-- message -->
                    <div class="mb-4">
                        <label for="message" class="block mb-3 text-90">{{ __('app.tickets.message') }}</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
                                rounded w-full py-2 opacity-75 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black
                                @error('message') border-red @enderror">
                                </textarea>
                        @error('message')
                        <p class="text-red text-xs italic pt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                </div>
                <!-- end:: card-body -->
                <div class="card-footer">
                    <button class="bg-black hover:bg-grey-darkest text-white font-bold h-12 py-2 px-4 rounded">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection