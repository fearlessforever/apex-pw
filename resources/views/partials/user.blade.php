<div class="ml-auto h-9 flex items-center mr-8">
  <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-16 h-16 mr-4 rounded-full border border-grey-light">
  <div class="text-grey-darkest">
      <p>{{ auth()->user()->name }}</p>
      <p class="pt-3">
          <a href="#" class="rounded bg-grey-light hover:bg-grey p-2 py-1 text-xs text-grey-darkest no-underline">
              {{ __('My Account') }}
          </a>
          <a href="/logout" class="rounded bg-red-light hover:bg-red p-2 py-1 ml-2 text-xs text-white no-underline">
              {{ __('Logout') }}
          </a>
      </p>
  </div>
</div>