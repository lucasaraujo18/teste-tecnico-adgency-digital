<div class="card">
    <div class="card-header">
        <h5 class="card-title">Card title</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('servers.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input id="name" name="name" type="text" class="form-control" placeholder="Informe seu e-mail" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="ip">Endereço IP</label>
                <input id="ip" name="ip" type="ip" class="form-control" placeholder="Informe sua senha" value="{{ old('ip') }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>