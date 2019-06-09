<li>
    <a class="flex items-center no-underline text-grey-darker group hover:text-blue" href="{{ url('/') }}">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
            class="fill-current w-6 h-6 mr-2 group-hover:text-primary">
            <path d="M17,10 L20,10 L10,0 L0,10 L3,10 L3,20 L17,20 L17,10 Z M8,14 L12,14 L12,20 L8,20 L8,14 Z"></path>
        </svg>
        <span> {{ __('app.menu.home') }}</span>
    </a>
</li>
<li>
    <a class="flex items-center no-underline text-grey-darker group hover:text-blue ml-10"
        href="{{ route('donate.request') }}">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
            class="fill-current w-6 h-6 mr-2 group-hover:text-primary">
            <path
                d="M10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,0 10,0 C4.4771525,0 0,4.4771525 0,10 C0,15.5228475 4.4771525,20 10,20 Z M11,15 L11,17 L9,17 L9,15 L6,15 L6,13 L10.5838882,13 L11.9970707,13 C12.5621186,13 13,12.5522847 13,12 C13,11.4438648 12.5509732,11 11.9970707,11 L10.5838882,11 L8,11 C6.34314575,11 5,9.65685425 5,8 C5,6.34314575 6.34314575,5 8,5 L9,5 L9,3 L11,3 L11,5 L14,5 L14,7 L9.41464715,7 L7.99077797,7 C7.45097518,7 7,7.44771525 7,8 C7,8.55613518 7.44358641,9 7.99077797,9 L9.41464715,9 L12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 L11,15 Z">
            </path>
        </svg>
        <span>{{ __('app.menu.donate') }}</span>
    </a>
</li>
<li>
    <a class="flex items-center no-underline text-grey-darker group hover:text-blue ml-10 {{ active_nav('donate.history') }}"
        href="{{ route('donate.history') }}">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
            class="fill-current w-6 h-6 mr-2 group-hover:text-primary">
            <path
                d="M0,3.99406028 C0,2.8927712 0.892622799,2 1.99508929,2 L17.0066023,2 C17.5552407,2 18,2.44386482 18,3 L18,4 L2,4 L2,5 L19.0066023,5 C19.5552407,5 20,5.44748943 20,5.99850233 L20,15.9972399 C20,17.1033337 19.1017876,18 18.0092049,18 L1.99079514,18 C0.891309342,18 0,17.1054862 0,16.0059397 L0,3.99406028 Z M16.5,13 C17.3284271,13 18,12.3284271 18,11.5 C18,10.6715729 17.3284271,10 16.5,10 C15.6715729,10 15,10.6715729 15,11.5 C15,12.3284271 15.6715729,13 16.5,13 Z"
                id="Combined-Shape"></path>
        </svg>
        <span> {{ __('app.menu.donate_history') }}</span>
    </a>
</li>
<li>
    <a class="flex items-center no-underline text-grey-darker group hover:text-blue ml-10"
        href="{{ route('tickets.index') }}">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
            class="fill-current w-6 h-6 mr-2 group-hover:text-primary">
            <path
                d="M14,7 C14,7.81404368 13.5749107,8.83930284 12.9961487,9.4180649 L11.4180649,10.9961487 C11.2143227,11.1998909 11,11.7148676 11,12 L11,13 L9,13 L9,12 C9,11.1832235 9.42588582,10.1599006 10.0038513,9.5819351 L11.5819351,8.00385134 C11.7857992,7.79998728 12,7.28336316 12,7 C12,5.8954305 11.1045695,5 10,5 C8.8954305,5 8,5.8954305 8,7 L6,7 C6,4.790861 7.790861,3 10,3 C12.209139,3 14,4.790861 14,7 Z M10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,0 10,0 C4.4771525,0 0,4.4771525 0,10 C0,15.5228475 4.4771525,20 10,20 Z M9,15 L11,15 L11,17 L9,17 L9,15 Z">
            </path>
        </svg>
        <span> {{ __('app.menu.support') }}</span>
    </a>
</li>
<li>
    <a class="flex items-center no-underline text-grey-darker group hover:text-blue ml-10"
        href="{{ route('profile.settings') }}">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
            class="fill-current w-6 h-6 mr-2 group-hover:text-primary">
            <path
                d="M4.99999861,5.00218626 C4.99999861,2.23955507 7.24419318,0 9.99999722,0 C12.7614202,0 14.9999958,2.22898489 14.9999958,5.00218626 L14.9999958,6.99781374 C14.9999958,9.76044493 12.7558013,12 9.99999722,12 C7.23857424,12 4.99999861,9.77101511 4.99999861,6.99781374 L4.99999861,5.00218626 Z M1.11022272e-16,16.6756439 C2.94172855,14.9739441 6.3571245,14 9.99999722,14 C13.6428699,14 17.0582659,14.9739441 20,16.6756471 L19.9999944,20 L0,20 L1.11022272e-16,16.6756439 Z"
                id="Combined-Shape"></path>
        </svg>
        <span> {{ __('app.menu.profile') }}</span>
    </a>
</li>