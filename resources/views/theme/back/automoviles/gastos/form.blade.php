@csrf
<input name="mesAnioGastos" id="mesAnioGastos" type="hidden" value="{{$mesAnio}}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h5>{{Lang::get('messages.Cost')}}</h5>
                <div class="controls">
                    <input type="text" class="form-control" id="GST_Costo_Gasto" name="GST_Costo_Gasto" required data-validation-required-message="{{Lang::get('messages.Required')}}" value="{{old('GST_Costo_Gasto', $gasto->GST_Costo_Gasto ?? '')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <h5>{{Lang::get('messages.Description')}}</h5>
                <div class="controls">
                    <textarea name="GST_Descripcion_Gasto" id="GST_Descripcion_Gasto" class="form-control" cols="30" rows="10" style="height: 100px;" required data-validation-required-message="{{Lang::get('messages.Required')}}">{{old('GST_Descripcion_Gasto', $gasto->GST_Descripcion_Gasto ?? '')}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="text-xs-right">
        <button type="submit" class="btn btn-info">{{Lang::get('messages.Save')}}</button>
        <a href="{{route('balance', ['id'=>Crypt::encrypt($automovil->id)])}}" class="btn btn-inverse">{{Lang::get('messages.Cancel')}}</a>
    </div>