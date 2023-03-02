<h1>Sites servidor n° {{ $server }}</h1>

<button><a href="{{ url('sites/create/' . $server) }}">Criar servidor</a></button>

@if (count($sites) > 0)
    <table>
        <thead>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach ($sites as $sites)
                <tr>
                    <td>{{ $sites->name }}</td>
                    <td>{{ $sites->url }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h1>Não há sites</h1>
@endif