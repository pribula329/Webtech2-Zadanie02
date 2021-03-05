function dostanHraca(nazov) {

    $.post('detailHrac.php','hrac='+nazov, function() {
        window.location.href = "detailHrac.php?hrac="+nazov;
    });


}