@extends('layout.master')
@section('title', 'Global Islamic Students Alliance')
@section('content')
<div class="mt-6 pt-10 grid gap-16 lg:grid-cols-2 lg:gap-y-10">
  @foreach ($discussions ?? [] as $discussion)
  <div>
    <div class="flex items-center">
      <div class="flex-shrink-0">
        <a>
          <span class="sr-only">{{ $discussion->created_by->name }}</span>
          <img class="h-10 w-10 rounded-full" src="{{ $discussion->created_by->avatar ?? asset('images/user.png') }}" alt="user avatar">
        </a>
      </div>
      <div class="ml-3">
        <p class="text-sm font-medium text-gray-900">
          <a>
            {{ $discussion->created_by->name }}
          </a>
        </p>
        <div class="flex space-x-1 text-sm text-gray-500">
          <time datetime="{{ $discussion->created_at }}">
            {{ $discussion->created_at->diffForHumans() }}
          </time>
        </div>
      </div>
      <a href="{{ route('up-vote', ['discussion_id' => $discussion->id]) }}" title="up-vote discussion" class="ml-auto flex items-baseline text-sm lg:text-base font-semibold text-green-600 pl-1 pr-2 py-0.5 rounded-full cursor-pointer hover:bg-green-100">
        <svg class="self-center flex-shrink-0 h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
        <span class="sr-only"> Up-vote Discussion </span>
        {{ number_format($discussion->up_votes->count()) }}
      </a>
      <p title="down-vote discussion" class="flex items-baseline text-sm lg:text-base font-semibold text-red-600 pl-1 pr-2 py-0.5 rounded-full cursor-pointer hover:bg-red-100">
        <svg class="self-center flex-shrink-0 h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        <span class="sr-only"> Down-vote discussion </span>
        {{ number_format($discussion->down_votes->count()) }}
      </p>
      <a href="{{ route('down-vote', ['discussion_id' => $discussion->id]) }}" title="reads" class="flex items-baseline text-sm lg:text-base font-semibold text-amber-500 pl-1 pr-2 py-0.5 rounded-full">
        <svg class="self-center flex-shrink-0 h-5 w-5 text-amber-500 mr-1" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span class="sr-only"> Reads </span>
        0
      </a>
    </div>
    <a href="{{ route('discussion', ['id' => $discussion->id]) }}" class="mt-2 block">
      <p class="text-xl font-semibold text-gray-900">
        {{ $discussion->title }}
      </p>
      <p class="mt-3 text-base text-gray-500 line-clamp-3">
        {{ $discussion->description }}
      </p>
    </a>
    <div class="mt-3">
      <a href="{{ route('discussion', ['id' => $discussion->id]) }}" class="text-base font-semibold text-stone-600 hover:text-stone-500"> Read discussion </a>
    </div>
  </div>
  @endforeach
</div>
@endsection
