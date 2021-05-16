<nav class="bg-gray-700 text-white fixed w-full top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex space-x-3">
                        <x-jet-application-mark class="block h-9 w-auto" />
                        <h1 class="font-lg mt-1 font-semibold">Layanan Terpadu</h1>
                    </a>
                </div>

                {{-- <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                </div> --}}
                <div class="flex-shrink-0 flex items-center ml-4">
                    <button
                    class="inline-flex items-center justify-center p-1 rounded-full text-white hover:bg-indigo-300 focus:outline-none focus:bg-indigo-300 transition"
                    @click="open = ! open"
                    >
                        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="flex items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none transition items-center space-x-2">
                                    <span>{{ Auth::user()->name }}</span>
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Pengaturan Akun') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Data Diri') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
                
            </div>

        </div>
    </div>

</nav>

{{-- Responsive Sidebar --}}
<div
x-show="open"
x-transition:enter="transition-all ease-in-out duration-1000"
x-transition:enter-start="transform -translate-x-full"
x-transition:enter-end="transform transform-x-0"
x-transition:leave="transition-all ease-in-out duration-1000"
x-transition:leave-start="transform transform-x-0"
x-transition:leave-end="transform -translate-x-full"
@click.away="open = false"
@keydown.escape="open = false"
class="fixed top-16 bottom-0 z-50 bg-white w-64 overflow-y-auto shadow-md">
    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 space-y-1">

        <!-- Account Management -->
        <x-dropdown icon="home" title="Beranda" href="dashboard"></x-dropdown>
        
        {{-- Siswa --}}
        @if (Auth::user()->siswa)
            <x-dropdown icon="home" title="Hasil Pembelajaran" href="siswa.report"></x-dropdown>
        @else
            @if (Auth::user()->teacher->role->contains('role', 1))
            <x-dropdown icon="archive" title="Data" :subs="[
                (object) ['link' => 'admin.teacher', 'icon' => 'account-multiple', 'title' => 'Guru'],
                (object) ['link' => 'admin.student', 'icon' => 'account-multiple', 'title' => 'Siswa'],
                (object) ['link' => 'admin.department', 'icon' => 'account-multiple', 'title' => 'Jurusan'],
                (object) ['link' => 'admin.classroom', 'icon' => 'account-multiple', 'title' => 'Kelas'],
                (object) ['link' => 'admin.year', 'icon' => 'account-multiple', 'title' => 'Tahun Pelajaran'],
                (object) ['link' => 'admin.semester', 'icon' => 'account-multiple', 'title' => 'Semester'],
                (object) ['link' => 'admin.schedule', 'icon' => 'account-multiple', 'title' => 'Jadwal Pelajaran'],
            ]"></x-dropdown>
            @endif

            @if (Auth::user()->teacher->role->contains('role', 2))
                <x-dropdown icon="" title="test" href="dashboard"></x-dropdown>
            @endif
        @endif
    </div>
</div>
<!-- Backdrop -->
<div
x-show="open"
x-transition:enter="transition ease-in-out duration-150"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="transition ease-in-out duration-150"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0"
class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
></div>
