<aside class="menu">
  @include('menuer::bulma.menu.label', compact('menu'))

  @if ($menu->hasChildren())
    <ul class="menu-list">
      @include('menuer::bulma.menu.list', ['items' => $menu->items()])
    </ul>
  @endif
</aside>
