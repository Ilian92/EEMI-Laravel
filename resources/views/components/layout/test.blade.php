<div>
    <x-nav/>
    <span>
        {{$slot}}
    </span>

    <x-foot name="{{\Illuminate\Support\Facades\Auth::user()->name}}" />
</div>


