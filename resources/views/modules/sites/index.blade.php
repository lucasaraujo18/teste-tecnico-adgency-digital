@extends('components.templates.main-component')
@section('content')
    <button class="button-create"><a href="{{ url('sites/create/' . $server) }}">Criar site</a></button>

    @if (count($sites) > 0)
        <table class="table table-bordered">
            <thead>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Ações</th>
            </thead>
            <tbody>
                @foreach ($sites as $site)
                    <tr>
                        <td>{{ $site->name }}</td>
                        <td>{{ $site->url }} </td>
                        <td class="action-table-buttons">
                            <form action="{{ route('sites.destroy', $site->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="delete" type="submit">Deletar</button>
                            </form> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>Não há sites</h1>
    @endif
@endsection