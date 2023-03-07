@extends('components.templates.main-component')
@section('content')
    <table class="table table-bordered">
        <thead>
            <th>Repositório</th>
            <th>URL</th>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script src="{{ asset('js/gitHubApi.js') }}"></script>
@endsection
