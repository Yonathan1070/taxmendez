//Nuevo Registro
$('#nuevo-registro').on('click', function(event){
    event.preventDefault();
    $(".preloader").fadeIn();
    var data = {};
    var modalName = $('#modalName').data('modal');
    if(modalName == 'accion-gastos'){
        data = {
            _token: $('input[name=_token]').val(),
            mesAnioGastos: document.getElementById('mesAnioGastosLista').value
        };
    }else{
        data = {
            _token: $('input[name=_token]').val()
        };
    }
    ajaxRequest($(this).attr('href'), data, 'crear', modalName);
});

//Editar Registro
$('#data-table').on('click', '.editar-registro', function(event){
    event.preventDefault();
    $(".preloader").fadeIn();
    var data = {};
    var modalName = $('#modalName').data('modal');
    if(modalName == 'accion-gastos'){
        data = {
            _method: 'PUT',
            _token: $('input[name=_token]').val(),
            mesAnioGastos: document.getElementById('mesAnioGastosLista').value
        };
    }else{
        data = {
            _method: 'PUT',
            _token: $('input[name=_token]').val()
        };
    }
    
    ajaxRequest($(this).attr('href'), data, 'editar', modalName);
});

//Guardar o actualizar
$('#'+$('#modalName').data('modal')).on('submit', '#form-general', function(event){
    event.preventDefault();
    $(".preloader").fadeIn();
    const form = $(this);
    var modalName = $('#modalName').data('modal');

    if(form.attr('enctype') == 'multipart/form-data'){
        var formData = new FormData(form[0]);
        var logoEmpresa = $('#EMP_Logo_Empresa')[0].files;
        var logoEmpresaTexto = $('#EMP_Logo_Texto_Empresa')[0].files;

        if(logoEmpresa.length > 0 ){
            formData.append('EMP_Logo_Empresa',logoEmpresa[0]);
        }
        if(logoEmpresaTexto.length > 0 ){
            formData.append('EMP_Logo_Texto_Empresa',logoEmpresaTexto[0]);
        }

        ajaxFilesRequest(form.attr('action'), formData, 'guardar', modalName);
    }else{
        ajaxRequest(form.attr('action'), form.serialize(), 'guardar', modalName);
    }
});

function swalWarning(form, title, text, type, confirm, cancel){
    swal({   
        title: title,   
        text: text,   
        type: type,   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: confirm,
        cancelButtonText: cancel
    }).then(function(result){
        if(result.value){
            $(".preloader").fadeIn();
            ajaxRequest(form.attr('action'), form.serialize(), 'eliminar', null, form);
        }
    });
}

$('#data-table').on('submit', '.eliminar-registro', function(event){
    event.preventDefault();
    const form = $(this);
    swalWarning(
        form,
        document.getElementById('SwalTitleWarning').value,
        document.getElementById('SwalDescWarning').value,
        document.getElementById('SwalTypeWarning').value,
        document.getElementById('SwalAcceptWarning').value,
        document.getElementById('SwalCancelWarning').value
    );
});

function ajaxRequest(url, data, action, modal, form){
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(respuesta){
            if(action == 'crear' || action == 'editar'){
                if(respuesta.tipo != 'error'){
                    $('#'+modal+' .modal-body').html(respuesta);
                    validaciones();
                    if(modal == 'accion-empresa'){
                        initDropify();
                    }
                    if(modal == 'accion-usuario'){
                        initDatePickerUser();
                    }
                    $(".preloader").fadeOut();
                    $('#'+modal).modal('show');
                }else{
                    $(".preloader").fadeOut();
                    taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
                }
            }else if(action == 'guardar'){
                if(respuesta.tipo == 'success'){
                    if(respuesta.balance == true){
                        refreshCalendar();
                    }else if(respuesta.valor != null || respuesta.valor != ""){
                        var control = document.getElementById(respuesta.control)
                        if(respuesta.control == "btn"){
                            control.style.background = respuesta.valor;
                        }else if(respuesta.control == "text"){
                            control.style.borderColor = respuesta.valor;
                        }else if(respuesta.control == "spin"){
                            control.style.color = respuesta.valor;
                        }
                        $('#'+modal).modal('hide');
                    }else{
                        tablaData(respuesta.view, modal);
                    }
                }
                $(".preloader").fadeOut();
                taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
            }else if(action == 'actualizar'){
                if(respuesta.tipo == 'success'){
                    tablaData(respuesta.view, modal);
                }
                $(".preloader").fadeOut();
                taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
            }else if(action == 'eliminar'){
                if(respuesta.tipo == 'success'){
                    var row = document.getElementById('row'+respuesta.row);
                    row.parentNode.removeChild(row);
                }
                $(".preloader").fadeOut();
                taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
            }else if(action == 'ordenar-menu'){
                $('#'+modal+' .modal-body').html(respuesta);
                inicializarNestable();
                $(".preloader").fadeOut();
                $('#'+modal).modal('show');
            }else if(action == 'cuadro-turnos' || action == 'cuadro-mensualidad'){
                if(respuesta.tipo != 'error'){
                    $('#'+modal+' .modal-body').html(respuesta);
                    if(action == 'cuadro-mensualidad'){
                        guardarGastos();
                        validaciones();
                    }
                    $(".preloader").fadeOut();
                    $('#'+modal).modal('show');
                }else{
                    $(".preloader").fadeOut();
                    taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
                }
            }else if(action == 'guardar-gastos'){
                taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
                if(respuesta.tipo =='success'){
                    $('#label').text('$ '+formatMoney(document.getElementById('GST_Costo_Gasto').value));
                    document.getElementById('form').style.display = 'none';
                    document.getElementById('formulario').style.display = 'none';
                    document.getElementById('label').style.display = 'block';
                    $('#ganancia').text('$ '+formatMoney(document.getElementById('produced').value - document.getElementById('GST_Costo_Gasto').value) + ((data.propietarios > 1) ? ' / '+data.propietarios+' = '+'$ '+formatMoney((document.getElementById('produced').value - document.getElementById('GST_Costo_Gasto').value)/data.propietarios)+' C/U' : ''));
                }
                $(".preloader").fadeOut();
            }else if (action == 'inicio'){
                if(respuesta.tipo != 'error'){
                    $('#'+modal).html(respuesta);
                }else{
                    taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
                }
                $(".preloader").fadeOut();
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown, error){
            $(".preloader").fadeOut();
            if (XMLHttpRequest.readyState == 4) {
                taxmendez.notificaciones('HTTP: '+XMLHttpRequest.statusText, 'TaxMendez', 'error', 5000);
            }
            else if (XMLHttpRequest.readyState == 0) {
                taxmendez.notificaciones('Red: '+XMLHttpRequest.statusText, 'TaxMendez', 'error', 5000);
            }
            else {
                var errors = error.responseJSON.errors;
                $.each(errors, function(key, val) {
                    $.each(val, function(key, mensaje){
                        taxmendez.notificaciones(mensaje, 'TaxMendez', 'error', 5000);
                    });
                    return false;
                });
            }
        }
    });
}

function ajaxFilesRequest(url, data, action, modal){
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        contentType: false,
        processData: false,
        success: function(respuesta){
            if(action == 'crear' || action == 'editar'){
                $('#'+modal+' .modal-body').html(respuesta);
                validaciones();
                if(modal == 'accion-empresa'){
                    initDropify();
                }
                if(modal == 'accion-usuario'){
                    initDatePickerUser();
                }
                $(".preloader").fadeOut();
                $('#'+modal).modal('show');
            }else if(action == 'guardar'){
                if(respuesta.tipo == 'success'){
                    tablaData(respuesta.view, modal);
                }
                $(".preloader").fadeOut();
                taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
            }else if(action == 'actualizar'){
                if(respuesta.tipo == 'success'){
                    tablaData(respuesta.view, modal);
                }
                $(".preloader").fadeOut();
                taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
            }else if(action == 'eliminar'){
                if(respuesta.tipo == 'success'){
                    var row = document.getElementById('row'+respuesta.row);
                    row.parentNode.removeChild(row);
                }
                $(".preloader").fadeOut();
                taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
            }else if(action == 'ordenar-menu'){
                $('#'+modal+' .modal-body').html(respuesta);
                inicializarNestable();
                $(".preloader").fadeOut();
                $('#'+modal).modal('show');
            }else if(action == 'cuadro-turnos' || action == 'cuadro-mensualidad'){
                $('#'+modal+' .modal-body').html(respuesta);
                if(action == 'cuadro-mensualidad'){
                    guardarGastos();
                    validaciones();
                }
                $(".preloader").fadeOut();
                $('#'+modal).modal('show');
            }else if(action == 'guardar-gastos'){
                taxmendez.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
                if(respuesta.tipo =='success'){
                    $('#label').text('$ '+formatMoney(document.getElementById('GST_Costo_Gasto').value));
                    document.getElementById('form').style.display = 'none';
                    document.getElementById('formulario').style.display = 'none';
                    document.getElementById('label').style.display = 'block';
                    $('#ganancia').text('$ '+formatMoney(document.getElementById('produced').value - document.getElementById('GST_Costo_Gasto').value) + ((data.propietarios > 1) ? ' / '+data.propietarios+' = '+'$ '+formatMoney((document.getElementById('produced').value - document.getElementById('GST_Costo_Gasto').value)/data.propietarios)+' C/U' : ''));
                }
                $(".preloader").fadeOut();
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown, error){
            $(".preloader").fadeOut();
            if (XMLHttpRequest.readyState == 4) {
                taxmendez.notificaciones('HTTP: '+XMLHttpRequest.statusText, 'TaxMendez', 'error', 5000);
            }
            else if (XMLHttpRequest.readyState == 0) {
                taxmendez.notificaciones('Red: '+XMLHttpRequest.statusText, 'TaxMendez', 'error', 5000);
            }
            else {
                var errors = error.responseJSON.errors;
                $.each(errors, function(key, val) {
                    $.each(val, function(key, mensaje){
                        taxmendez.notificaciones(mensaje, 'TaxMendez', 'error', 5000);
                    });
                    return false;
                });
            }
        }
    });
}

function inicializarPaginador(){
    $('.pagination').on('click', function(event){
        event.preventDefault(); 
        $(".preloader").fadeIn();
        var page = $(this).attr('href').split('page=')[1];
        var url = $(this).attr('data-url');
        pagination(page, url);
    });
}

inicializarPaginador();

function validaciones(){
    ! function(window, document, $) {
        "use strict";
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation()
    }(window, document, jQuery);
}

function tablaData(respuesta, modal){
    $('#paginador').remove();
    $('#data-table').html(respuesta);
    inicializarPaginador();
    $('#'+modal).modal('hide');
}

function refreshCalendar(){
    $('#calendar').fullCalendar( 'refetchEvents' );
    $('#accion-balance').modal('hide');
}

function pagination(page, url){
    $.ajax({
        url:url+"?page="+page,
        success:function(data){
            $('#paginador').remove();
            $('#data-table').html(data);
            inicializarPaginador();
            $(".preloader").fadeOut();
        }
    });
}

function initDropify(){
    // Basic
    $('.dropify').dropify({
        messages: {
            'default': document.getElementById('DropifyDefault').value,
            'replace': document.getElementById('DropifyReplace').value,
            'remove':  document.getElementById('DropifyRemove').value,
            'error':   document.getElementById('DropifyError').value
        }
    });
}

//Nuevo Registro
$('#ordenar-menu').on('click', function(event){
    event.preventDefault();
    $(".preloader").fadeIn();
    const data = {
        _token: $('input[name=_token]').val()
    };
    ajaxRequest($(this).attr('href'), data, 'ordenar-menu', $('#modalName').data('modal'));
});

function inicializarNestable(){
    $('#nestable').nestable().on('change', function(){
        const data = {
            menu:window.JSON.stringify($('#nestable').nestable('serialize')),
            _token: $('input[name=_token]').val()
        };
        $.ajax({
            url:'guardarorden',
            type:'POST',
            dataType:'JSON',
            data:data,
            success:function(respuesta){
                taxmendez.notificaciones(respuesta.mensaje, respuesta.TM, respuesta.type);
            }
        });
    });

    $('#nestable').nestable('expandAll');
}

function selectRol(sel) {
    var conductor = 'Conductor';
    if(sel.options[sel.selectedIndex].text.toLowerCase() == conductor.toLowerCase()){
        document.getElementById('divConductorFijo').style.display = 'block';
    }else{
        document.getElementById('divConductorFijo').style.display = 'none';
    }
}

function initDatePickerUser(){
    $('#USR_Fecha_Vencimiento_Licencia_Usuario').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        format: 'YYYY-MM-DD',
        locale: 'es'
    });
    $('#USR_Fecha_Nacimiento_Usuario').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        format: 'YYYY-MM-DD'
    });
}

$('#actions').on('submit', '.cuadro-turnos', function(event){
    event.preventDefault();
    const form = $(this);
    $(".preloader").fadeIn();
    ajaxRequest(form.attr('action'), form.serialize(), 'cuadro-turnos', 'accion-balance', form);
});

$('#actions').on('submit', '.cuadro-mensualidad', function(event){
    event.preventDefault();
    const form = $(this);
    $(".preloader").fadeIn();
    ajaxRequest(form.attr('action'), form.serialize(), 'cuadro-mensualidad', 'accion-balance', form);
});

$('#actions').on('submit', '.cuadro-anual', function(event){
    event.preventDefault();
    const form = $(this);
    $(".preloader").fadeIn();
    ajaxRequest(form.attr('action'), form.serialize(), 'cuadro-mensualidad', 'accion-balance', form);
});

function guardarGastos(){
    $('#saveGastos').on('submit', '#formulario', function(event){
        event.preventDefault();
        const form = $(this);

        $(".preloader").fadeIn();
        ajaxRequest(form.attr('action'), form.serialize(), 'guardar-gastos', null, null);
    });
}

function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
    try {
      decimalCount = Math.abs(decimalCount);
      decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
  
      const negativeSign = amount < 0 ? "-" : "";
  
      let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
      let j = (i.length > 3) ? i.length % 3 : 0;
  
      return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    } catch (e) {
      console.log(e)
    }
};

$('#cambiar-modo').on('change', function(event){
    event.preventDefault();
    $(".preloader").fadeIn();
    var data = {};
    data = {
        _token: $('input[name=_token]').val(),
        tipo: $(this).is(":checked")
    };
    ajaxRequest($(this).data('url'), data, 'inicio', $('#divName').val());
});