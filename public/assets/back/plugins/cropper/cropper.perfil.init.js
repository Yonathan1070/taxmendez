var $dataX = $('#dataX');
var $dataY = $('#dataY');
var $dataHeight = $('#dataHeight');
var $dataWidth = $('#dataWidth');
var $dataRotate = $('#dataRotate');
var $dataScaleX = $('#dataScaleX');
var $dataScaleY = $('#dataScaleY');
var options = {
    preview: '.img-preview',
    crop: function (e) {
        $dataX.val(Math.round(e.detail.x));
        $dataY.val(Math.round(e.detail.y));
        $dataHeight.val(Math.round(e.detail.height));
        $dataWidth.val(Math.round(e.detail.width));
        $dataRotate.val(e.detail.rotate);
        $dataScaleX.val(e.detail.scaleX);
        $dataScaleY.val(e.detail.scaleY);
    }
};
var uploadedImageName = 'cropped.jpg';
var uploadedImageType = 'image/jpeg';
var uploadedImageURL;

$(function () {

    'use strict';
  
    $('#imageEditor').cropper(options);

    $('#imageEditor').on({
        ready: function (e) {
          console.log(e.type);
        },
        cropstart: function (e) {
          console.log(e.type, e.detail.action);
        },
        cropmove: function (e) {
          console.log(e.type, e.detail.action);
        },
        cropend: function (e) {
          console.log(e.type, e.detail.action);
        },
        crop: function (e) {
          console.log(e.type);
        },
        zoom: function (e) {
          console.log(e.type, e.detail.ratio);
        }
      }).cropper(options);
  
      // Import image
    var $inputImage = $('#inputImage');

    if (URL) {
        $inputImage.change(function () {
        var files = this.files;
        var file;

        if (!$('#imageEditor').data('cropper')) {
            return;
        }

        if (files && files.length) {
            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {
                uploadedImageName = file.name;
                uploadedImageType = file.type;

                if (uploadedImageURL) {
                    URL.revokeObjectURL(uploadedImageURL);
                }

                uploadedImageURL = URL.createObjectURL(file);
                $('#imageEditor').cropper('destroy').attr('src', uploadedImageURL).cropper(options);
                $inputImage.val('');
            } else {
                window.alert('Please choose an image file.');
            }
        }
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }
});

function changeMethod(method, option, secondOption){
    var dataImage = $('#imageEditor').cropper("getImageData");
    if(method == 'scaleX' || method == 'scaleY'){
        if(dataImage.scaleX == -1){
            option = 1;
        }
        if(dataImage.scaleY == -1){
            option = 1;
        }
    }
    if(method == 'aspectRatio'){
        options[method] = option;
        $('#imageEditor').cropper('destroy').cropper(options);
    }

    var result = $('#imageEditor').cropper(method, option, secondOption);
    if(method == 'getCroppedCanvas'){
        if(options.aspectRatio == '1' || options.aspectRatio == 'NaN'){
            if($('#dataHeight').val() == $('#dataWidth').val()){
                if (result) {
                    var image = result.toDataURL(uploadedImageType);
                    form = new FormData();
                    form.append('USR_Foto_Perfil_Usuario', image);
                    jQuery.ajax({
                        url:"foto-perfil",
                        headers: {
                            'X-CSRF-TOKEN': $('input[name=_token]').val()
                        },
                        data:form,
                        method:"POST",
                        processData: false,
                        contentType: false,
                        success: function(data){
                            if(data.success){
                                document.getElementById('Foto_Perfil_Top').setAttribute(
                                    'src', 'data:image/png;base64,'+data.image
                                );
                                document.getElementById('Foto_Perfil_Top_Notif').setAttribute(
                                    'src', 'data:image/png;base64,'+data.image
                                );
                                document.getElementById('Foto_Perfil_Aside').setAttribute(
                                    'src', 'data:image/png;base64,'+data.image
                                );
                                document.getElementById('Foto_Perfil').setAttribute(
                                    'src', 'data:image/png;base64,'+data.image
                                );
                                $('#imageEditor').cropper('destroy');
                                $('#modal-editor').modal('hide');
                                taxmendez.notificaciones(data.message, data.title, data.type);
                            }
                        }
                    });
                }
            }else{
                taxmendez.notificaciones($('#cropDimention').val(), 'TaxMendez', 'error');
            }
        }else{
            taxmendez.notificaciones($('#cropCut').val(), 'TaxMendez', 'error');
        }
    }
    if ($.isPlainObject(result)) {
        try {
            alert(JSON.stringify(result));
        } catch (e) {
            console.log(e.message);
        }
    }
}