@extends('components.templates.main-component')
@section('content')    
    @if (Auth::user()->auth_type == 'github')
    <div>
       <p class="home-text">Olá {{ Auth::user()->name }}</p>
    </div>
    <div class="home_user_data">
        <div>
            <ul class="home-list">
                <li><i class="far fa-envelope"></i> {{ Auth::user()->email }}</li>
                <li><i class="fab fa-github"></i> {{ Auth::user()->github_username }}</li>
            </ul>
        </div>
        <div>
            <img src="{{ Auth::user()->avatar }}" class="home-photo">
        </div>
    </div>
    @else
    <div>
        Olá {{ Auth::user()->name }}
        Entre com o GitHub para uma melhor permofance do sistema
    </div>
    @endif
@endsection
