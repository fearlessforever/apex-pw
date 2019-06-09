@foreach($replies as $reply)
<div class="mt-10">
    <div class="flex flex-wrap border-t border-grey-lighter py-5 pb-4">
        <img src="https://randomuser.me/api/portraits/women/17.jpg" alt="" class="h-12 w-12 rounded-full inline block">
        <div class="ml-3">
            <span>{{ $reply->user->name }}</span>
            <span class="block text-sm pt-2">{{ $reply->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <div class="leading-normal">
        {{ $reply->message }}
    </div>
</div>
@endforeach