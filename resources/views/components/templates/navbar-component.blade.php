<div class="nav_bar">
    <ul>
        <li><a href="{{ route('servers.index') }}">Servidores</a></li>
        <li><a href="{{ route('github.index') }}">Repositórios</a></li>
    </ul>
    <div>
        <div class="nav-bar-avatar">
            <img src="{{ Auth::user()->avatar}}" alt="">
        </div>
        <div class="nav-bar-menu"> 
            <div class="nav-bar-user-settings">
                <p>Olá {{ Auth::user()->name }}</p>
                <p>Editar Usuário</p>
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
    </div>
</div>
