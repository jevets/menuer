<ul>
  @foreach ($items as $child)
    <li>
      @include('menuer::bulma.menu.item', ['item' => $child])
    </li>
  @endforeach
</ul>
