@include('components.header.header.component')
<div>
    <ul>
        <li><a href="{{ route('servers.index') }}">Servidores</a></li>
        <li><a href="{{ route('github.index') }}">Repositórios</a></li>
    </ul>
    <div>
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
