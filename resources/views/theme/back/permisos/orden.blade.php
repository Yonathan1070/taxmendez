<div class="card">
    <div class="card-body collapse show b-t">
        <h4 class="card-title m-b-0">{{Lang::get('messages.ShortMenu')}}</h4>
        <div class="col-lg-12 col-md-12">
            @csrf
            <div class="myadmin-dd dd" id="nestable">
                <ol class="dd-list">
                    @foreach ($menu as $item)
                        <li class="dd-item" data-id="{{$item->id}}">
                            <div class="dd-handle"> <i class="{{$item->PRM_Icono_Permiso}}"></i> {{(Lang::get('messages.'.$item->PRM_Slug_Permiso) == 'messages.'.$item->PRM_Slug_Permiso) ? $item->PRM_Nombre_Permiso : Lang::get('messages.'.$item->PRM_Slug_Permiso) }} </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
        <div class="col-lg-12 col-md-12" style="display: none;">
            <div class="myadmin-dd-empty dd" id="nestable2">
            </div>
        </div>
        <div class="col-lg-4 col-md-12" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <div class="dd myadmin-dd" id="nestable-menu">
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top">
            <div class="card-body">
                <div class="row">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('messages.Close')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>