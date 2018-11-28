<div class="ml-auto h-9 flex items-center mr-8">
  <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-16 h-16 mr-4 rounded-full shadow-inner">
  <div class="text-grey-darkest">
      <p>{{ auth()->user()->name }}</p>
      <p class="pt-3">
          <a href="/logout" class="p-2 py-1 bg-white border border-red-dark text-xs text-red-dark hover:bg-red-dark hover:text-white no-underline">
              {{ __('Logout') }}
          </a>
      </p>
  </div>
</div>