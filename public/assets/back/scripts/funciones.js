var taxmendez = function (){
    return{
        notificaciones: function(mensaje, titulo, tipo, tiempo){
            $.toast({
                heading: titulo,
                text: mensaje,
                position: 'top-right',
                loaderBg:'#ff6849',
                icon: tipo,
                hideAfter: tiempo, 
                stack: 6
              });
        },
    }
}();

function formHref(ruta, atributos, token, notificacionId){
    var parametros = JSON.parse(atributos);
    var hidden = '';
    for (var key in parametros) {
        hidden += '<input type="hidden" name="'+key+'" value="' + parametros[key] + '" />';
    }
    
    var formulario = $('<form action="' + ruta + '" method="post">' +
        '<input type="hidden" name="_token" value="' + token + '" />'+
        '<input type="hidden" name="notificacion" value="true" />'+
        '<input type="hidden" name="notificacionId" value="'+ notificacionId +'" />'+
        hidden +
    '</form>');
    $('body').append(formulario);
    formulario.submit();
}