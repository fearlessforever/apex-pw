<nav class="hidden lg:block lg:w-1/6 mr-8">
    <ul class="list-reset mb-8">
        <div class="pb-3 font-bold uppercase">{{ __('app.tickets.title_nav') }}</div>
        <li>
            <a href="{{ route('tickets.create') }}"
                class="flex items-center no-underline text-grey-darker group hover:text-blue py-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 mr-2 icon-chat-group">
                    <path class="primary"
                        d="M20.3 12.04l1.01 3a1 1 0 0 1-1.26 1.27l-3.01-1a7 7 0 1 1 3.27-3.27zM11 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z">
                    </path>
                    <path class="secondary"
                        d="M15.88 17.8a7 7 0 0 1-8.92 2.5l-3 1.01a1 1 0 0 1-1.27-1.26l1-3.01A6.97 6.97 0 0 1 5 9.1a9 9 0 0 0 10.88 8.7z">
                    </path>
                </svg>
                <span>{{ __('app.tickets.new') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('tickets.index') }}"
                class="flex items-center no-underline text-grey-darker group hover:text-blue py-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 mr-2 icon-calendar-date">
                    <path class="primary"
                        d="M5 4h14a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm0 5v10h14V9H5z">
                    </path>
                    <path class="secondary"
                        d="M13 13h3v3h-3v-3zM7 2a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0V3a1 1 0 0 1 1-1zm10 0a1 1 0 0 1 1 1v3a1 1 0 0 1-2 0V3a1 1 0 0 1 1-1z">
                    </path>
                </svg>
                <span>{{ __('app.tickets.title') }}</span>
            </a>
        </li>
    </ul>
</nav>