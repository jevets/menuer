@foreach ($items as $item)
  @if ($item->can())
    @can($item->can())
      <li>
        @include('menuer::bulma.menu.item')
        @if ($item->hasChildren())
          @include('menuer::bulma.menu.submenu', ['items' => $item->items()])
        @endif
      </li>
    @endcan
  @endif
@endforeach
