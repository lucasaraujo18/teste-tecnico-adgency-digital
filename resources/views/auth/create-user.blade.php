@extends('components.templates.auth-component')
@section('auth-content')    
    <div class="form_template">
        <h5 class="form-title">Registrar</h5>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input id="name" name="name" type="text" class="form-control" placeholder="Informe seu Nome">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" class="form-control" placeholder="Informe seu e-mail">
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Informe sua senha">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirme sua senha</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirme sua senha">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="privacy_terms" name="privacy_terms" value="1">
                <label class="form-check-label" for="privacy_terms">Termos de Privacidade</label>
            </div>
            <button type="submit" class="btn form-button form-button-primary">Registrar</button>
        </form>
    </div>
@endsection