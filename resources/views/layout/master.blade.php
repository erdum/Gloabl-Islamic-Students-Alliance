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
        <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl">Global Islamic Students Alliance</h2>
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
        <form action="#">
          <div class="bg-white rounded-lg px-4 shadow-sm overflow-hidden focus-within:ring-stone-500 focus-within:ring-2">
            <label for="title" class="sr-only">Title</label>
            <input type="text" name="title" id="title" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:outline-none" placeholder="Title">
            <label for="description" class="sr-only">Description</label>
            <textarea rows="2" name="description" id="description" class="block w-full border-0 py-0 resize-none placeholder-gray-500 focus:outline-none sm:text-sm" placeholder="Write a description..."></textarea>
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
            <!-- Actions: These are just examples to demonstrate the concept, replace/wire these up however makes sense for your project. -->
            <div class="flex flex-nowrap justify-end py-2 px-2 space-x-2 sm:px-3">
              <div class="flex-shrink-0">
                <label id="listbox-label" class="sr-only"> Add a label </label>
                <div class="relative">
                  <button type="button" class="relative inline-flex items-center rounded-full py-2 px-2 bg-gray-100 text-sm font-medium text-gray-500 whitespace-nowrap hover:bg-gray-200 hover:text-gray-600 sm:px-3" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                    <!--
                  Heroicon name: solid/tag

                  Selected: "text-gray-300", Default: "text-gray-500"
                -->
                    <svg class="text-gray-400 flex-shrink-0 h-5 w-5 sm:-ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    <!-- Selected: "text-gray-900" -->
                    <span class="hidden truncate sm:ml-2 sm:block"> Label </span>
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
                  <ul class="hidden absolute right-0 z-10 mt-1 w-52 bg-white shadow max-h-56 rounded-lg py-3 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-0">
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

  </script>
  @yield('scripts')
</body>

</html>
