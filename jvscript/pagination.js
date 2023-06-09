$(document).ready(function () {

    var table = $('#example').DataTable( {
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-download"></i> Excel'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa-solid fa-download"></i> PDF'
            }
        ]
    });
    table.buttons().container()
    .appendTo('#example_wrapper .col-md-6:last-child');
    
});