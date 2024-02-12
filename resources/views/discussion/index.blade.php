@extends('layout.master')
@section('title', $discussion->title)
@section('content')
@csrf
<div class="mt-6 pt-10 flex flex-col gap-y-6 xl:gap-y-10">
  <div class="flex items-center gap-y-6 justify-between flex-wrap">
    <div class="flex items-center gap-x-5">
      <div class="flex-shrink-0">
        <div class="relative">
          <img class="h-16 w-16 rounded-full" src="{{ $discussion->created_by->avatar ?? asset('images/user.png') }}" alt="">
          <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
        </div>
      </div>
      <div>
        <h1 class="text-2xl font-medium text-gray-900">{{ $discussion->created_by->name }}</h1>
        <p class="text-sm font-medium text-gray-500">
          Started discussion
          on <time class="text-gray-900" datetime="{{ $discussion->created_at }}">{{ Carbon\Carbon::parse($discussion->created_at)->format('M d, Y') }}</time>
        </p>
      </div>
    </div>
    <div class="flex xl:ml-auto sm:gap-x-1">

      @php $is_up_voted = $discussion->up_votes()
        ->where('user_id', auth()->user()?->id)->count() > 0
      @endphp
      <a onclick="upVote(event, this);" href="{{ route('up-vote', ['discussion_id' => $discussion->id]) }}" title="up-vote discussion" class="ml-auto flex items-baseline text-lg lg:text-2xl font-semibold text-green-600 {{ $is_up_voted ? 'bg-green-100' : '' }} pl-2 pr-4 py-0.5 rounded-full cursor-pointer hover:bg-green-100">
        <svg class="self-center flex-shrink-0 h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
        <span class="sr-only"> Up-vote Discussion </span>
        <span>
          {{ number_format($discussion->up_votes->count()) }}
        </span>
      </a>

      @php $is_down_voted = $discussion->down_votes()
        ->where('user_id', auth()->user()?->id)->count() > 0
      @endphp
      <a onclick="downVote(event, this);" href="{{ route('down-vote', ['discussion_id' => $discussion->id]) }}" title="down-vote discussion" class="flex items-baseline text-lg lg:text-2xl font-semibold text-red-600 {{ $is_down_voted ? 'bg-green-100' : '' }} pl-2 pr-4 py-0.5 rounded-full cursor-pointer hover:bg-red-100">
        <svg class="self-center flex-shrink-0 h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        <span class="sr-only"> Down-vote discussion </span>
        <span>
          {{ number_format($discussion->down_votes->count()) }}
        </span>
      </a>

      <p title="reads" class="flex items-baseline text-lg lg:text-2xl font-semibold text-amber-500 pl-2 pr-4 py-0.5 rounded-full">
        <svg class="self-center flex-shrink-0 h-8 w-8 text-amber-500 mr-1" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span class="sr-only"> Reads </span>
        0
      </p>
    </div>
  </div>
  <p class="text-2xl font-semibold text-gray-900">{{ $discussion->title }}</p>
  <p class="text-lg font-medium text-gray-500">{{ $discussion->description }}</p>
</div>
@endsection
@section('scripts')
<script>

  // Send the timestamp when user closed the page
  window.onbeforeunload = function () {
    const token = document.querySelector('[name=_token]').value;
    const payload = new FormData();
    payload.set('_token', token);
    payload.set('time', Date.parse(new Date) / 1000);
    navigator.sendBeacon(
      "{{ route('page-close-time', ['discussion_id' => $discussion->id]) }}", 
      payload
    );
  };

  async function upVote(event, upvoteBtn) {
    event.preventDefault();
    const counter = upvoteBtn.querySelectorAll('span')[1];
    const currentCount = parseInt(counter.innerText);
    const upvoteUrl = upvoteBtn.getAttribute('href');
    const token = document.querySelector('[name=_token]').value;

    if (upvoteBtn.classList.contains('bg-green-100')) {
      upvoteBtn.classList.remove('bg-green-100');
      counter.innerText = currentCount - 1;
      const res = await fetch(upvoteUrl, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': token }
      });

      if (res.status != 200) {
        upvoteBtn.classList.add('bg-green-100');
        counter.innerText = currentCount;
      }
    } else {
      upvoteBtn.classList.add('bg-green-100');
      counter.innerText = currentCount + 1;
      const res = await fetch(upvoteUrl, {
        headers: { 'X-CSRF-TOKEN': token }
      });

      if (res.status != 200) {
        upvoteBtn.classList.remove('bg-green-100');
        counter.innerText = currentCount;
      }
    }
  }

  async function downVote(event, downvoteBtn) {
    event.preventDefault();
    const counter = downvoteBtn.querySelectorAll('span')[1];
    const currentCount = parseInt(counter.innerText);
    const downvoteUrl = downvoteBtn.getAttribute('href');
    const token = document.querySelector('[name=_token]').value;

    if (downvoteBtn.classList.contains('bg-red-100')) {
      downvoteBtn.classList.remove('bg-red-100');
      counter.innerText = currentCount - 1;
      const res = await fetch(downvoteUrl, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': token }
      });

      if (res.status != 200) {
        downvoteBtn.classList.add('bg-red-100');
        counter.innerText = currentCount;
      }
    } else {
      downvoteBtn.classList.add('bg-red-100');
      counter.innerText = currentCount + 1;
      const res = await fetch(downvoteUrl, {
        headers: { 'X-CSRF-TOKEN': token }
      });

      if (res.status != 200) {
        downvoteBtn.classList.remove('bg-red-100');
        counter.innerText = currentCount;
      }
    }
  }

</script>
@endsection
