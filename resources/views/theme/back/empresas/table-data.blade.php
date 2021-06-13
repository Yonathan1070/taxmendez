<table class="table table-bordered table-striped" id="data-table">
    <thead>
        <tr>
            <th>{{Lang::get('messages.NIT')}}</th>
            <th>{{Lang::get('messages.CompanyName')}}</th>
            <th>{{Lang::get('messages.Logo')}}</th>
            <th>{{Lang::get('messages.LogoText')}}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $permEditar = can4('editar_empresa'); $permEliminar = can4('eliminar_empresa'); ?>
        @foreach ($empresas as $empresa)
            <tr id="row{{$empresa->id}}">
                <td>{{$empresa->EMP_NIT_Empresa}}</td>
                <td>{{$empresa->EMP_Nombre_Empresa}}</td>
                <td>
                    @if ($empresa->EMP_Logo_Empresa != null || $empresa->EMP_Logo_Empresa != '')
                        <img id="LogoCompany" src="data:image/png;base64, {{$empresa->EMP_Logo_Empresa}}" alt="{{'Logo '.$empresa->EMP_Nombre_Empresa}}" height="27" width="50" />
                    @endif
                </td>
                <td>
                    @if ($empresa->EMP_Logo_Texto_Empresa != null || $empresa->EMP_Logo_Texto_Empresa != '')
                        <img id="LogoTextCompany" src="data:image/png;base64, {{$empresa->EMP_Logo_Texto_Empresa}}" alt="{{'Logo Texto '.$empresa->EMP_Nombre_Empresa}}" height="29" width="148" />
                    @endif
                </td>
                <td>
                    @if (can2('editar_empresa'))
                        <a href="{{route('editar_empresa', $empresa->id)}}" class="editar-registro">
                            <i class="{{$permEditar->PRM_Icono_Permiso}}"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="paginador">
    <a href="{{$empresas->previousPageUrl()}}" class="btn waves-effect waves-light btn-success {{($empresas->previousPageUrl() == '') ? 'disabled' : ''}} pagination" data-url="{{route('page_empresas')}}">{{Lang::get('messages.Previous')}}</a>
    <a href="{{$empresas->nextPageUrl()}}" class="btn waves-effect waves-light btn-success {{($empresas->nextPageUrl() == '') ? 'disabled' : ''}} pagination" data-url="{{route('page_empresas')}}">{{Lang::get('messages.Next')}}</a>
</div>