<nav class="bg-white px-6 py-4 shadow">
    <div class="flex flex-col container mx-auto md:flex-row md:items-center md:justify-between">
        <div class="flex justify-between items-center">
            <div>
                <a class="text-gray-800 text-xl font-bold md:text-2xl" href="#">Laravel
                    <span class="text-blue-500">Blog</span></a>
            </div>
            <div>
                <button type="button" class="block text-gray-800 hover:text-gray-600 focus:text-gray-600 focus:outline-none md:hidden">
                    <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="flex flex-col md:flex-row md:-mx-4">
            <a class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0 {{ active_link('home') }}" href="{{ route('home') }}">Home</a>
            <a class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0 {{ active_link('posts.index') }}" href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
            <a class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0 {{ active_link('dashboard') }}" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            <a class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0 {{ active_link('skills') }}" href="{{ route('skills') }}">{{ __('Skills') }}</a>

            <ul>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
