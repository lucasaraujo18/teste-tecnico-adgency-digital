@extends('components.templates.auth-component')
@section('auth-content')    
    <div class="form-template">
        <label>Olá {{ Auth::user()->name }}, confirme seu e-mail para usar o nosso sistema</label>
        <form method="POST" action="{{ route('user.verifyCode') }}">
            @csrf
            <div class="form-group">
                <label for="verify_code">Código de Verificação</label>
                <input id="verify_code" name="verify_code" type="text" class="form-control" placeholder="Informe seu Nome">
            </div>
            <button type="submit" class="btn form-button form-button-primary">Verificar</button>
        </form>
    </div>
@endsection