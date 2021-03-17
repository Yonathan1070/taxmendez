$(document).ready(function() {
    $('.myTable').DataTable({
        responsive: false,
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
});