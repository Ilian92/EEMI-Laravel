<h1>modifier : {{$todo->name}} - {{$todo->id}}</h1>

<form action="{{route('todo.update', $todo->id)}}" method="post">
    @csrf
    <input type="text" value="{{$todo->name}}" name="name">
    <button type="submit">modifier</button>
</form>
