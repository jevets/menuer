@if ($item->url())
  <a href="{{ $item->url() }}">{{ $item->label() }}</a>
@else
  {{ $item->label() }}
@endif
