@extends('layouts.app')

@section('content')
<div class="w-full max-w-screen mx-auto px-4 flex py-8">
    <div class="flex-1">
        <div class="card">
            <div class="card-header">
                <h2>{{ $ticket->subject }}</h2>
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
                <form method="POST" action="{{ route('tickets.reply', ['id' => $ticket->id]) }}" class="p-8">
                    @csrf
                    <div class="flex flex-wrap">
                        <img src="https://randomuser.me/api/portraits/women/17.jpg" alt=""
                            class="h-12 w-12 rounded-full inline block">
                        <div class="ml-3">
                            <span>{{ $ticket->user->name }}</span>
                            <span class="block text-sm pt-2">{{ $ticket->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="mt-4 leading-normal">
                        {{ $ticket->message }}
                    </div>
                    @include('tickets.replies', ['replies' => $ticket->replies])
                    @if(!$ticket->isClosed())
                    <div class="border-t border-grey-lighter mt-8"></div>
                    <div class="mt-4">
                        <label for="" class="block mb-3 text-90">Adicionar resposta</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="bg-grey-lighter h-12 appearance-none border-2 border-grey-ligther
                            rounded w-full py-2 opacity-75 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-black
                            @error('message') border-red @enderror">
                            </textarea>
                        @error('message')
                        <p class="text-red text-xs italic pt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <button class="bg-black hover:bg-grey-darkest text-white font-bold mt-4 h-12 py-2 px-4 rounded">
                            Adicionar Resposta
                        </button>
                    </div>
                    @endif
                </form>
                @if($ticket->isClosed())
                <div class="bg-grey-lightest text-indigo py-4 text-center flex items-center justify-center">
                    <span>Ticket foi marcado como resolvido e não pode ser reaberto.</span>
                </div>
                @endif
            </div>
        </div>
    </div>
    <nav class="bg-white rounded shadow hidden lg:block lg:w-1/4 ml-8 h-full">
        <dl class="ticket-details border-b border-grey-lighter p-8">
            <dt>Autor</dt>
            <dd>{{ $ticket->user->name }}</dd>
            <dt>Criado</dt>
            <dd>{{ $ticket->created_at->format('l à\s H:i') }}</dd>
            <dt>Última atualização</dt>
            <dd>{{ $ticket->updated_at->format('l à\s H:i') }}</dd>
        </dl>
        <dl class="ticket-details border-b border-grey-lighter p-8">
            <dt>ID</dt>
            <dd>#{{ $ticket->id }}</dd>
            <dt>Status</dt>
            <dd>
                <span class="badge badge-{{ $ticket->present()->statusLabel()['color'] }}">
                    {{ $ticket->present()->statusLabel()['name'] }}
                </span>
            </dd>
            <dt>Setor</dt>
            <dd>{{ $ticket->category->name }}</dd>
        </dl>
        @if(!$ticket->isClosed())
        <a href="#" class="no-underline" onclick="event.preventDefault();
        document.getElementById('mark-as-solved').submit()">
            <div class=" bg-grey-lightest hover:bg-grey-lighter py-4 text-sm text-indigo rounded text-center font-bold
            flex items-center justify-center">
                Marcar como resolvido
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                    id="Check" x="0px" y="0px" viewBox="0 0 20 20" enable-background="new 0 0 20 20"
                    xml:space="preserve">
                    <path fill="#FFFFFF"
                        d="M8.294,16.998c-0.435,0-0.847-0.203-1.111-0.553L3.61,11.724c-0.465-0.613-0.344-1.486,0.27-1.951  c0.615-0.467,1.488-0.344,1.953,0.27l2.351,3.104l5.911-9.492c0.407-0.652,1.267-0.852,1.921-0.445  c0.653,0.406,0.854,1.266,0.446,1.92L9.478,16.34c-0.242,0.391-0.661,0.635-1.12,0.656C8.336,16.998,8.316,16.998,8.294,16.998z" />
                </svg>
            </div>
        </a>
        <form id="mark-as-solved" method="POST" action="{{ route('tickets.destroy', ['id' => $ticket->id]) }}"
            style="display: none;">
            @method('DELETE')
            @csrf
        </form>
        @endif
    </nav>
</div>
@endsection