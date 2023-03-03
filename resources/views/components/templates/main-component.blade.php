@include('components.default.head')

<body class="main_background">
    <div>
        @include('components.templates.navbar-component')
    </div>

    <div>
        <div>
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>