function dostanHraca(nazov) {

    $.post('detailHrac.php','hrac='+nazov, function() {
        window.location.href = "detailHrac.php?hrac="+nazov;
    });


}

$(document).ready(function() {
    $('#table1').DataTable( {
        columnDefs: [ {
            targets: [ 4 ],
            orderData: [4, 2 ]
        }],
        "searching": false,
        "paging": false,
        "lengthChange": false,
        "info": false,
        "order": [[1,'asc']],
    } );
} );