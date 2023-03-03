@include('components.default.head')

<body class="main_background">
    <div>
        @include('components.templates.navbar-component')
    </div>
    
    <div class="main-content">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>