ma todo :

<ul>
    <li>{{$todo->id}}</li>
    <li>{{$todo->name}}</li>
    <li>
        <a href="{{route('todo.updateform', $todo->id)}}">Modifier</a>
    </li>
</ul>
