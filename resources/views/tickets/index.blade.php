@extends('layouts.app')

@section('content')
<div class="w-full max-w-screen mx-auto px-4 flex py-8">
    @include('tickets.menu')
    <div class="flex-1">
        <div class="card h-full">
            <div class="card-header">
                <h2>{{ __('app.tickets.title') }}</h2>
            </div>
            <div class="card-body p-0">
                @if(flash()->message)
                <div class="w-full alert {{ flash()->class }} p-4">
                    <div class="flex">
                        <div class="py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="w-8 mr-4 icon-check inline-flex">
                                <circle cx="12" cy="12" r="10" class="primary"></circle>
                                <path class="secondary"
                                    d="M10 14.59l6.3-6.3a1 1 0 0 1 1.4 1.42l-7 7a1 1 0 0 1-1.4 0l-3-3a1 1 0 0 1 1.4-1.42l2.3 2.3z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            {{ flash()->message }}
                        </div>
                    </div>
                </div>
                @endif
                <table class="w-full table">
                    <thead>
                        <tr>
                            <th class="px-2 text-left">Assunto</th>
                            <th class="px-2 text-left">ID</th>
                            <th class="px-2 text-center">Departamento</th>
                            <th class="px-2 text-center">Status</th>
                            <th class="px-4 text-right">Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr>
                            <td class="py-4 px-2 text-left whitespace-no-wrap">
                                <a href="{{ route('tickets.show', ['id' => $ticket->id]) }}"
                                    class="text-indigo no-underline hover:underline">
                                    {{ $ticket->subject }}
                                </a>
                            </td>
                            <td class="py-4 whitespace-no-wrap">#{{ $ticket->id }}</td>
                            <td class="py-4 px-2 text-center whitespace-no-wrap">{{ $ticket->category->name }}</td>
                            <td class="py-4 px-2 text-center whitespace-no-wrap">
                                <span class="badge badge-{{ $ticket->present()->statusLabel()['color'] }}">
                                    {{ $ticket->present()->statusLabel()['name'] }}
                                </span>
                            </td>
                            <td class="py-4 px-3 text-right whitespace-no-wrap">
                                {{ $ticket->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center mt-10">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection