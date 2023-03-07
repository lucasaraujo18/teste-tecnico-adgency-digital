@extends('components.templates.main-component')
@section('content')
    <div class="form-template">
        <h5 class="form-title">Criar Site</h5>
        <form method="POST" action="{{ route('sites.store') }}">
            @csrf
            <input type="hidden" name="server_id" value="{{ $server }}">
            <div class="form-group">
                <label for="name">Nome do site</label>
                <input id="name" name="name" type="text" class="form-control" placeholder="Informe o nome" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="url">URL do site</label>
                <input id="url" name="url" type="text" class="form-control" placeholder="Informe a url" value="{{ old('url') }}">
                @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn form-button form-button-primary">Criar site</button>
        </form>
    </div>
@endsection