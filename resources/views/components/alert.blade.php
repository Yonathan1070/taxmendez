<div class="alert alert-{{$tipo}}">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h3 class="text-{{$tipo}}">
        TaxMendez.
    </h3>
    @if (is_object($mensaje))
        <ul>
            @foreach ($mensaje->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @else
        {{$mensaje}}
    @endif
</div>