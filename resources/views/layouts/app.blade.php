
   @include('partials.head')
   @include('partials.navbar')
   @include('partials.sidebar')

    <main class="app-main">
        @include('components.contet-header')
        
        @yield('content')
    </main>

    @include('partials.footer')
