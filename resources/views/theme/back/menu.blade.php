@foreach ($menusComposer as $key => $item)
    @include("theme.back.menu-item", ["item" => $item])
@endforeach