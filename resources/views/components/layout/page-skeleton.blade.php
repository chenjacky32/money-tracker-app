@php
    $route = Route::currentRouteName();

    $skeleton = match (true) {
        // Skeleton di render berdasarkan route yang sedang diakses
        request()->routeIs('dashboard') => 'home',
        request()->routeIs('transactions.index') => 'transactions',
        request()->routeIs('reports.index') => 'reports',
        request()->routeIs('profile.index') => 'profile',
        default => 'default',
    };
@endphp

<x-dynamic-component :component="'skeleton.' . $skeleton" />
