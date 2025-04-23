{{-- @if (1==1)
    <h1>salut</h1>
@endif

Variable = {{ $variable }}

@foreach ($tableau as $tbs)
    <p>{{ $tbs }}</p>
@endforeach --}}

<h1>Mes Todos</h1>

<div>Nombre de todos : {{$todoCount}}</div>

<ul>
    @foreach ($todos as $todo)
        <li>
            {{ $todo->id }} - {{ $todo->name }}
            {{-- Modèle Binding: on envoie l'id d'un todo ($todo->id) à laravel alors qu'il attend un objet et il va automatiquement chercher l'objet qui possède cet id --}}
            <form action='{{route("todo.delete", $todo->id)}}' method='POST'>
                @method('DELETE')
                @csrf
                <button type="submit">DELETE</button>
            </form>
        </li>
    @endforeach
</ul>

<h2>Ajouter:</h2>

@if ($errors->any())
    {{implode('', $errors->all(':message'))}}
@endif

<form action="{{route('todo.add')}}" method="post">
    @csrf
    <input type="text" name="name" placeholder="Nom">
    <button type="submit">Ajouter</button>
</form>