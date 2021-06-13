//Nuevo Registro
$('#nuevo-registro').on('click', function(event){
    event.preventDefault();
    $(".preloader").fadeIn();
    const data = {
        _token: $('input[name=_token]').val()
    };
    ajaxRequest($(this).attr('href'), data, 'crear', $('#nuevo-registro').data('modal'));
});

//Editar Registro
$('#data-table').on('click', '.editar-registro', function(event){
    event.preventDefault();
    $(".preloader").fadeIn();
    const data = {
        _method: 'PUT',
        _token: $('input[name=_token]').val()
    };
    ajaxRequest($(this).attr('href'), data, 'editar', $('#nuevo-registro').data('modal'));
});

//Guardar o actualizar
$('#'+$('#nuevo-registro').data('modal')).on('submit', '#form-general', function(event){
    event.preventDefault();
    $(".preloader").fadeIn();
    const form = $(this);
    ajaxRequest(form.attr('action'), form.serialize(), 'guardar', $('#nuevo-registro').data('modal'));
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
                $('#'+modal+' .modal-body').html(respuesta);
                validaciones();
                if(modal == 'accion-empresa'){
                    initDropify();
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
            }
        },
        error: function(error){
            var errors = error.responseJSON.errors;
            $.each(errors, function(key, val) {
                $.each(val, function(key, mensaje){
                    $(".preloader").fadeOut();
                    taxmendez.notificaciones(mensaje, 'TaxMendez', 'error', 5000);
                });
                return false;
            });
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