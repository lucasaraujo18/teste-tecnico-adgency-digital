<div class="nav_bar">
    <ul>
        <li><a href="{{ route('servers.index') }}">Servidores</a></li>
        <li><a href="{{ route('github.index') }}">Repositórios</a></li>
    </ul>
    <div>
        @if (Auth::user()->auth_type == 'github')
            <div class="nav-bar-avatar" onclick="navBarSettings()">
                <img src="{{ Auth::user()->avatar}}" alt="">
                <p>{{ Auth::user()->name}}</p>
            </div>
            <div class="nav-bar-menu"> 
                <div class="nav-bar-user-settings">
                    <p>Olá {{ Auth::user()->name }}</p>
                    <button>
                        <a id="logoutButton" class="dropdown-item" href="{{ route('logout') }}" data-cy="logoutBtn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <p class="dropdown-menu-text">Sair</p>
                        </a>
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <input id="token-logout" name="token" class="d-none" type="hidden">
                    </form>
                </div>
            </div>
        @else
            <div class="connect-git">
                <button> <i class="fab fa-github"></i> Conectar com o GitHub</button>
            </div>
         @endif
    </div>
    <script src="{{ asset('js/navBar.js') }}"></script>
</div>
