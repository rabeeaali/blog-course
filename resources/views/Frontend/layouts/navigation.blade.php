<nav class="bg-white px-6 py-4 shadow">
    <div class="flex flex-col container mx-auto md:flex-row md:items-center md:justify-between">
        <div class="flex justify-between items-center">
            <div>
                <a href="/" class="text-gray-800 text-xl font-bold md:text-2xl">Brand</a>
            </div>
            <div>
                <button type="button"
                    class="block text-gray-800 hover:text-gray-600 focus:text-gray-600 focus:outline-none md:hidden">
                    <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                        <path
                            d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="md:flex flex-col items-center md:flex-row md:-mx-4 hidden">
            @auth
            <a href="#" class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">{{ auth()->user()->name }}</a>
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = ! dropdownOpen"
                    class="relative block h-10 w-10 rounded-full overflow-hidden shadow focus:outline-none">
                    <img class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=296&amp;q=80"
                        alt="Your avatar">
                </button>

                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
                    style="display: none;"></div>

                <div x-show="dropdownOpen"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                    style="display: none;">
                    <a href="./profile.html"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-600  hover:text-white">Profile</a>

                    <a href="#"
                        onclick="document.getElementById('logout-user').submit();"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-600  hover:text-white">Logout</a>

                    <form action="{{ route('logout') }}" method="post" id="logout-user">
                        @csrf
                    </form>
                </div>
            </div>
            @endauth
            @guest
            <a href="{{ route('login') }}" class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">Login</a>
            <a href="{{ route('register') }}" class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">Register</a>
            @endguest
        </div>
    </div>
</nav>