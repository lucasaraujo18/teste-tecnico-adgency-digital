@include('components.header.header.component')
<body>
    <div>
        @include('components.templates.navbar.component')
    </div>

    <div>
        <div>
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>