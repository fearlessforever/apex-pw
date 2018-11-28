<nav class="hidden lg:block lg:w-1/6 mr-8">
    <ul class="list-reset mb-8">
        <div class="pb-3 font-bold uppercase">{{ __('app.my_profile') }}</div>
        <li>
            <a href="{{ route('profile.settings') }}" class="flex items-center no-underline text-grey-darker group hover:text-blue py-2 {{ active_nav('profile.settings') }}">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fill-current w-6 h-6 mr-2 group-hover:text-primary">
                    <path d="M4.99999861,5.00218626 C4.99999861,2.23955507 7.24419318,0 9.99999722,0 C12.7614202,0 14.9999958,2.22898489 14.9999958,5.00218626 L14.9999958,6.99781374 C14.9999958,9.76044493 12.7558013,12 9.99999722,12 C7.23857424,12 4.99999861,9.77101511 4.99999861,6.99781374 L4.99999861,5.00218626 Z M1.11022272e-16,16.6756439 C2.94172855,14.9739441 6.3571245,14 9.99999722,14 C13.6428699,14 17.0582659,14.9739441 20,16.6756471 L19.9999944,20 L0,20 L1.11022272e-16,16.6756439 Z" id="Combined-Shape"></path>
                </svg>
                <span>{{ __('app.profile') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('profile.password') }}" class="flex items-center no-underline text-grey-darker group hover:text-blue py-2 {{ active_nav('profile.password') }}">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fill-current w-6 h-6 mr-2 group-hover:text-primary">
                    <path d="M11,14.7324356 C11.5978014,14.3866262 12,13.7402824 12,13 C12,11.8954305 11.1045695,11 10,11 C8.8954305,11 8,11.8954305 8,13 C8,13.7402824 8.40219863,14.3866262 9,14.7324356 L9,17 L11,17 L11,14.7324356 Z M13,6 C13,4.34314575 11.6568542,3 10,3 C8.34314575,3 7,4.34314575 7,6 L7,8 L13,8 L13,6 Z M4,8 L4,6 C4,2.6862915 6.6862915,0 10,0 C13.3137085,0 16,2.6862915 16,6 L16,8 L17.0049107,8 C18.1067681,8 19,8.90195036 19,10.0085302 L19,17.9914698 C19,19.1007504 18.1073772,20 17.0049107,20 L2.99508929,20 C1.8932319,20 1,19.0980496 1,17.9914698 L1,10.0085302 C1,8.8992496 1.8926228,8 2.99508929,8 L4,8 Z" id="Combined-Shape"></path>
                </svg>
                <span>{{ __('app.authentication') }}</span>
            </a>
        </li>
    </ul>
</nav>