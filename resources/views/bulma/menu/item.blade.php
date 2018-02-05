@if ($item->url())
  <a href="{{ $item->url() }}" class="{{ $item->active() ? 'is-active' : '' }} {{ $classes or '' }}">
    {{ $item->label() }}
  </a>
@else
  {{ $item->label() }}
@endif
