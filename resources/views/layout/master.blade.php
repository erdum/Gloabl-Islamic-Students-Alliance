<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - GISA</title>
  <meta charset="utf-8" name="description" content="Unite beyond borders, sects, ideologies, and identities. Welcome to a global sanctuary for Islamic intellectual minds, unite and stand for the true cause. GISA | Global Islamic Students Alliance">
  @vite('resources/css/app.css')
</head>

<body>
  <div class="bg-white pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
    <div class="relative max-w-lg mx-auto divide-y-2 divide-gray-200 lg:max-w-7xl">
      <div>
        <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl">
          <a href="{{ route('home') }}">
            Global Islamic Students Alliance
          </a>
        </h2>
        <div class="mt-3 sm:mt-4 lg:grid lg:grid-cols-2 lg:gap-5 lg:items-center">
          <p class="text-xl text-gray-500">
            Unite beyond borders, sects, ideologies, and identities. Welcome to a global sanctuary for Islamic intellectual minds, unite and stand for the true cause.
          </p>
          <form class="mt-6 flex flex-col sm:flex-row lg:mt-0 lg:justify-end">
            <div>
              <label for="email-address" class="sr-only">Search topic, user, word...</label>
              <input id="email-address" name="email-address" type="email" autocomplete="email" class="appearance-none w-full px-4 py-2 border border-gray-300 text-base rounded-md text-gray-900 bg-white placeholder-gray-500 focus:outline-none focus:ring-stone-500 focus:border-stone-500 lg:max-w-xs" placeholder="Search topic, user, word...">
            </div>
            <div class="mt-2 flex-shrink-0 w-full flex rounded-md shadow-sm sm:mt-0 sm:ml-3 sm:w-auto sm:inline-flex">
              <button onclick="openDiscussionWritingModal(event)" class="w-full bg-stone-500 px-4 py-2 border border-transparent rounded-md flex items-center justify-center text-base font-medium text-white hover:bg-stone-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-500 sm:w-auto sm:inline-flex">
                Start Discussion
              </button>
            </div>
          </form>
        </div>
      </div>
      @yield('content')
    </div>
  </div>

  <!-- This example requires Tailwind CSS v2.0+ -->
  <div id="write-modal" class="fixed z-10 inset-0 overflow-hidden hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

      <div id="write-modal-overlay" class="fixed inset-0 bg-gray-500 bg-opacity-80 transition-opacity ease-in duration-200 opacity-0" aria-hidden="true"></div>

      <div id="write-modal-textbox" class="absolute top-1/2 left-1/2 w-2/5 -translate-x-1/2 -translate-y-1/2 transition-transform ease-out duration-200 scale-0">
        <form method="POST" action="{{ route('add-discussion') }}">
          @csrf
          <div class="bg-white rounded-lg px-4 shadow-sm overflow-hidden focus-within:ring-stone-500 focus-within:ring-2">
            <label for="title" class="sr-only">Title</label>
            <input required type="text" name="title" id="title" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:outline-none" placeholder="Title">
            <label for="description" class="sr-only">Description</label>
            <textarea required rows="4" name="description" id="description" class="block mt-2 w-full border-0 py-0 resize-none placeholder-gray-500 focus:outline-none sm:text-sm" placeholder="Express your freedom..."></textarea>
            <!-- Spacer element to match the height of the toolbar -->
            <div aria-hidden="true">
              <div class="py-2">
                <div class="h-9"></div>
              </div>
              <div class="h-px"></div>
              <div class="py-2">
                <div class="py-px">
                  <div class="h-9"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="absolute bottom-0 inset-x-px">
            <div class="flex flex-nowrap justify-end py-2 px-2 space-x-2 sm:px-3">
              <div class="flex-shrink-0">
                <label id="listbox-label" class="sr-only"> Add a label </label>
                <div class="relative">
                  <button onclick="openTopicPopover()" type="button" class="relative inline-flex items-center rounded-full py-2 px-2 bg-gray-100 text-sm font-medium text-gray-500 whitespace-nowrap hover:bg-gray-200 hover:text-gray-600 sm:px-3" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                    <!--
                  Heroicon name: solid/tag

                  Selected: "text-gray-300", Default: "text-gray-500"
                -->
                    <svg class="text-gray-400 flex-shrink-0 h-5 w-5 sm:-ml-1" data-slot="icon" aria-hidden="true" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                      <path clip-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z" fill-rule="evenodd"></path>
                    </svg>
                    <!-- Selected: "text-gray-900" -->
                    <span class="hidden truncate sm:ml-2 sm:block">Topics</span>
                  </button>
                  <!--
                Select popover, show/hide based on select state.

                Entering: ""
                  From: ""
                  To: ""
                Leaving: "transition ease-in duration-100"
                  From: "opacity-100"
                  To: "opacity-0"
              -->
                  <ul id="topics-popover" class="hidden absolute right-0 z-10 mt-1 w-52 bg-white shadow max-h-56 rounded-lg py-3 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-0">
                    <!--
                  Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                  Highlighted: "bg-gray-100", Not Highlighted: "bg-white"
                -->
                    <li class="bg-white cursor-default select-none relative py-2 px-3" id="listbox-option-0" role="option">
                      <div class="flex items-center">
                        <span class="block font-medium truncate"> Unlabelled </span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="border-t border-gray-200 px-2 py-2 flex justify-between items-center space-x-3 sm:px-3">
              <div class="flex">
                <button type="button" class="-ml-2 -my-2 rounded-full px-3 py-2 inline-flex items-center text-left text-gray-400 group">
                  <!-- Heroicon name: solid/paper-clip -->
                  <svg class="-ml-1 h-5 w-5 mr-2 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                  </svg>
                  <span class="text-sm text-gray-500 group-hover:text-gray-600 italic">Attach images</span>
                </button>
              </div>
              <div class="flex-shrink-0">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-stone-600 hover:bg-stone-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-500">Post</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer class="bg-white static sm:absolute bottom-0 w-full" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
      <div class="mt-12 border-t border-gray-200 pt-8">
        <p class="text-base text-gray-400 sm:text-center">&copy; {{ Carbon\Carbon::now()->year }} Global Islamic Students Alliance, All rights reserved.</p>

      </div>
    </div>
  </footer>

  <!-- Global notification live region, render this permanently at the end of the document -->
  <div aria-live="assertive" class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
    <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
      <!--
        Notification panel, dynamically insert this into the live region when it needs to be displayed

        Entering: "transform ease-out duration-300 transition"
          From: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
          To: "translate-y-0 opacity-100 sm:translate-x-0"
        Leaving: "transition ease-in duration-100"
          From: "opacity-100"
          To: "opacity-0"
      -->
      @foreach ($errors->all() as $error)
        <div onclick="closeErrorToast(this, event)" class="max-w-sm w-full bg-red-200 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden transition ease-in duration-100">
          <div class="p-4">
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="ml-3 w-0 flex-1 pt-0.5">
                <p class="text-sm font-medium text-black">Error!</p>
                <p class="mt-1 text-sm text-gray-800">{{ $error }}</p>
              </div>
              <div class="ml-4 flex-shrink-0 flex">
                <button class="rounded-md inline-flex text-gray-700 hover:text-gray-500 focus:outline-none">
                  <span class="sr-only">Close</span>
                  <!-- Heroicon name: solid/x -->
                  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>

  <script>

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        closeDiscussionWritingModal();
      }
    });

    document.getElementById('write-modal-overlay').addEventListener(
      'click',
      () => closeDiscussionWritingModal()
    );

    document.getElementById('topics-popover').addEventListener(
      'blur',
      () => closeTopicPopover()
    );

    function closeErrorToast(elem, event) {

      if (
        Array.from(event.composedPath()).map(item => item.tagName)
          .includes('BUTTON')
      ) {
        elem.classList.add('opacity-0', 'translate-y-2');
        setTimeout(() => elem.remove(), 200);
      }
    };

    function openDiscussionWritingModal(event) {
      event.preventDefault();
      const writeModal = document.getElementById('write-modal');
      const writeModalOverlay = document.getElementById('write-modal-overlay');
      const textBox = document.getElementById('write-modal-textbox');

      writeModal.classList.remove('hidden');

      setTimeout(() => {
        writeModalOverlay.classList.remove('opacity-0');
        textBox.classList.remove('scale-0');
        writeModalOverlay.classList.add('opacity-100');
        textBox.classList.add('scale-1');
        document.getElementById('title').focus();
      }, 0);
    };

    function closeDiscussionWritingModal() {
      const writeModal = document.getElementById('write-modal');
      const writeModalOverlay = document.getElementById('write-modal-overlay');
      const textBox = document.getElementById('write-modal-textbox');

      writeModalOverlay.classList.remove('opacity-100');
      textBox.classList.remove('scale-1');

      writeModalOverlay.classList.add('opacity-0');
      textBox.classList.add('scale-0');
      setTimeout(() => {
        writeModal.classList.add('hidden');
      }, 200);
    };

    function openTopicPopover() {
      const topicsPopover = document.getElementById('topics-popover');
      topicsPopover.classList.remove('hidden');
      topicsPopover.focus();
    };

    function closeTopicPopover() {
      const topicsPopover = document.getElementById('topics-popover');
      topicsPopover.classList.add('hidden');
    };

  </script>
  @yield('scripts')
</body>

</html>
