var consulta = $("#searchTable").DataTable({
    oLanguage: {
        sEmptyTable:     $('#EmptyTable').val(),
        sInfo:           $('#Info').val(),
        sInfoEmpty:      $('#InfoEmpty').val(),
        sInfoFiltered:   $('#InfoFiltered').val(),
        sInfoPostFix:    $('#InfoPostFix').val(),
        sDecimal:        $('#Decimal').val(),
        sThousands:      $('#Thousands').val(),
        sLengthMenu:     $('#LengthMenu').val(),
        sLoadingRecords: $('#LoadingRecords').val(),
        sProcessing:     $('#Processing').val(),
        sSearch:         $('#Search').val(),
        sSearchPlaceholder : $('#SearchPlaceholder').val(),
        sUrl:            $('#Url').val(),
        sZeroRecords:    $('#ZeroRecords').val(),
        oPaginate: {
            sFirst:      $('#first').val(),
            sLast:       $('#last').val(),
            sNext:       $('#next').val(),
            sPrevious:   $('#previous').val(),
        }
    }
});

$(document).ready(function() {
    $("[id^='searchTable']").find("[class^='dataTables_length']").remove();
    $("[id^='searchTable']").find("[class^='dataTables_info']").remove();
    $("[id^='searchTable']").find("[class^='dataTables_filter']").remove();
    $("[id^='searchTable']").find("[class^='dataTables_paginate']").remove();
});

$("#inputSearch").keyup( function(){
    consulta.search($(this).val()).draw();

    $("header").css({
        "height": "100vh",
        "background": "rgba(0, 0, 0, 0.5)"
    });

    if($("#inputSearch").val() == ""){
        $("header").css({
            "height": "auto",
            "background": "#fff"
        });

        $("#search").fadeOut();
    }else{
        $("#search").fadeIn();
    }
});


$(".srh-btn").click(function (){
    document.getElementById("inputSearch").value = "";

    $("header").css({
        "height": "auto",
        "background": "#fff"
    });

    $("#search").fadeOut();
});