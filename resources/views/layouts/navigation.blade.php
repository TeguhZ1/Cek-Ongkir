<nav class="bg-gradient-to-r from-green-600/30 to-emerald-600/30 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo dan Brand -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 hover:opacity-75 transition">
                    <div class="bg-gradient-to-br from-green-400 to-emerald-500 p-2 rounded-lg shadow-lg">
                        <i class="fas fa-truck-fast text-white text-2xl drop-shadow-md"></i>
                    </div>
                    <span class="text-xl font-bold text-white drop-shadow-sm">
                        CekOngkir
                    </span>
                </a>
            </div>

            <!-- User Menu -->
            <div class="flex items-center">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center space-x-3 bg-white/10 px-4 py-2 rounded-full border border-white/20
                                   hover:bg-white/20 transition duration-150 focus:outline-none group">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=22c55e&color=ffffff"
                             class="h-8 w-8 rounded-full ring-2 ring-green-400/50">
                        <div class="hidden md:block text-left">
                            <span class="block text-sm font-semibold text-white group-hover:text-green-100">
                                {{ Auth::user()->name }}
                            </span>
                            <span class="block text-xs text-green-100/70">
                                {{ Auth::user()->email }}
                            </span>
                        </div>
                        <i class="fas fa-chevron-down text-sm text-green-100/70 group-hover:text-green-100"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open"
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white/90 backdrop-blur-md rounded-xl shadow-lg py-1
                                ring-1 ring-black/5 border border-white/20"
                         style="display: none;">

                        <div class="px-4 py-2 border-b border-gray-100/50">
                            <p class="text-xs text-gray-500">Login sebagai</p>
                            <p class="text-sm font-medium text-gray-700 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 transition">
                            <i class="fas fa-user-circle mr-2 text-green-500"></i>
                            Pengaturan Akun
                        </a>

                        <a href="{{ route('history') }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 transition">
                            <i class="fas fa-history mr-2 text-green-500"></i>
                            Riwayat Cek Ongkir
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
