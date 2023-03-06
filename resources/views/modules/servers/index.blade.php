@extends('components.templates.main-component')
@section('content')
    <button class="button-create"><a href="{{ route('servers.create') }}">Criar servidor</a></button>

    @if (count($servers) > 0)
        <table class="table table-bordered">
            <thead>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Ações</th>
            </thead>
            <tbody>
                @foreach ($servers as $server)
                    <tr>
                        <td>{{ $server->name }}</td>
                        <td>{{ $server->ip }} </td>
                        <td class="action-table-buttons">
                            <button class="specific"><a href="{{ url('servers/' . $server->id . '/sites') }}">Sites</a></button>
                            <form action="{{ route('servers.destroy', $server->id) }}" method="POST">
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
        <h1>Não há servidores</h1>
    @endif

@endsection
