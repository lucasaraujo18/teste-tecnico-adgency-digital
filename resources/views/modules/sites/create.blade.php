@extends('components.templates.main-component')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Card title</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('sites.store') }}">
                @csrf
                <input type="hidden" name="server_id" value="{{ $server }}">
                <div class="form-group">
                    <label for="name">Nome do site</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Informe seu e-mail" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="url">URL do site</label>
                    <input id="url" name="url" type="url" class="form-control" placeholder="Informe sua senha" value="{{ old('url') }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection