@props([
    'name' => 'jean'
    ])


<div @class([
    'text-black',
    'bg-red-500' => $name === 'alois'
])>
    coucou je suis le dooter {{$name}}

</div>
