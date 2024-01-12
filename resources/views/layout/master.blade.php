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
              <input id="email-address" name="email-address" type="email" autocomplete="email" required class="appearance-none w-full px-4 py-2 border border-gray-300 text-base rounded-md text-gray-900 bg-white placeholder-gray-500 focus:outline-none focus:ring-stone-500 focus:border-stone-500 lg:max-w-xs" placeholder="Search topic, user, word...">
            </div>
            <div class="mt-2 flex-shrink-0 w-full flex rounded-md shadow-sm sm:mt-0 sm:ml-3 sm:w-auto sm:inline-flex">
              <button type="button" class="w-full bg-stone-500 px-4 py-2 border border-transparent rounded-md flex items-center justify-center text-base font-medium text-white hover:bg-stone-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-500 sm:w-auto sm:inline-flex">
                Start Discussion
              </button>
            </div>
          </form>
        </div>
      </div>
      @yield('content')
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
  @yield('scripts')
</body>

</html>
