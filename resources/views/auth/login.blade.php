<div class="card">
    <div class="card-header">
        <h5 class="card-title">Card title</h5>
    </div>
    <div class="card-body">
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <a class="btn" href="{{ url('auth/github') }}" style="background: #313131; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
            Login with GitHub
        </a>
    </div>
</div>