<h1>Seus servidores</h1>

<button><a href="{{ route('servers.create') }}">Criar servidor</a></button>

@if (count($servers) > 0)
    <table>
        <thead>
            <th>Nome</th>
            <th>Endereço</th>
        </thead>
        <tbody>
            @foreach ($servers as $server)
                <tr>
                    <td>{{ $server->name }}</td>
                    <td>{{ $server->ip }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h1>Não há servidores</h1>
@endif
