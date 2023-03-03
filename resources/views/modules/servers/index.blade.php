@extends('components.templates.main-component')
@section('content')
    <h1>Seus servidores</h1>

    <button><a href="{{ route('servers.create') }}">Criar servidor</a></button>

    @if (count($servers) > 0)
        <table>
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
                        <td>
                            <button><a href="{{ url('sites/index/' . $server->id) }}">Sites</a></button>
                            <form action="{{ route('servers.destroy', $server->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit">Deletar</button>
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
