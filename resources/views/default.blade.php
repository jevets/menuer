@if ($menu->hasChildren())
  <ul>
    @foreach ($menu->items() as $item)
      <li>
        @include('menuer::item', ['item' => $item])
        @if ($item->hasChildren())
          <ul>
            @foreach ($item->items() as $child)
              <li>
                @include('menuer::item', ['item' => $child])
              </li>
            @endforeach
          </ul>
        @endif
      </li>
    @endforeach
  </ul>
@endif
