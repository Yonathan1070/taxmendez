<div class="card">
    <div class="card-body">
        <h4 class="card-title m-b-0">{{Lang::get('messages.EditPermission')}} {{$permiso->PRM_Nombre_Permiso}}</h4>
        <form action="{{route('actualizar_permiso', ['id'=>$permiso->id])}}" class="m-t-40" method="POST" novalidate id="form-general">
            @method('PUT')
            @include('theme.back.permisos.form')
            <div class="border-top">
                <div class="card-body">
                    <div class="row">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('messages.Close')}}</button>
                        <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>