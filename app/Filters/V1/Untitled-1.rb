 @can('viewAdmin', App\Models\User::class)
    <x-nav-link :navigate="false" href="{{ route('filament.admin.pages.dashboard') }}" :active="request()->routeIs('filament.admin.pages.dashboard')">
        {{ __('menu.admin') }}
    </x-nav-link>
    @endcan

    @can('viewSuperAdmin', App\Models\User::class)
    <x-nav-link :navigate="false" href="{{ route('filament.admin.pages.dashboard') }}" :active="request()->routeIs('filament.admin.pages.dashboard')">
        {{ __('menu.superAdmin') }}
    </x-nav-link>
    @endcan