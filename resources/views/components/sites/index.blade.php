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
            @foreach ($sites as $site)
                <tr>
                    <td>{{ $site->name }}</td>
                    <td>{{ $site->url }} </td>
                    <td>
                        <form action="{{ route('sites.destroy', $site->id) }}" method="POST">
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
    <h1>Não há sites</h1>
@endif