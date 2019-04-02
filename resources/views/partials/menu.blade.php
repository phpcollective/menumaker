<div class="col-md-4">
    <div class="card">
        <div class="card-header">Menu</div>
        <div class="list-group">
            @foreach (auth()->menus('left') as $menu)
                <a class="list-group-item list-group-item-action{{ $menu->active ? ' active' : '' }}" href="{{ $menu->url() }}">{{ $menu->name }}</a>
            @endforeach
        </div>
    </div>
</div>