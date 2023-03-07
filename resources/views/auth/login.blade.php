@extends('components.templates.auth-component')
@section('auth-content')    
    <div class="form_template">
        <h5 class="form-title">Login</h5>
        <form method="POST" action="{{ route('login.authenticate') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" class="form-control" placeholder="Informe seu e-mail" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Informe sua senha">
            </div>
            <button type="submit" class="btn form-button form-button-primary">Entrar</button>
        </form>
        <a class="btn form-button form-button-git" href="{{ url('auth/github') }}">
            Entrar com o GitHub  <i class="fab fa-github"></i>
        </a> 
        <a class="login-link" href="{{ route('users.create') }}">Registrar-se</a>
    </div>
@endsection