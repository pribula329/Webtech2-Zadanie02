<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/dizajn.css" rel="stylesheet">

</head>
<body>

<header>
    <h1>Vytváranie umiestnenia</h1>
</header>
<main class="container">

    <?php
    if (isset($_POST["idOsoba"])) {
        if ($_POST["idOsoba"] == "null" || $_POST["idOH"] == "null") {
            echo '<span class="upozornenie">Prosím vyber Olympionika aj Olympiadu !!!</span><br>';
        } else {
            pridajUmiestnenie();
        }
    }
    ?>

    <form action="vytvorUmiestnenie.php" method="post">
<?php

vyberHraca();


?>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Názov disciplíny</span>
            </div>
            <input required type="text" id="disciplina" class="form-control" name="disciplina">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Umiestenie</span>
            </div>
            <input required type="number" id="umiestnenue" class="form-control" name="umiestnenie">
        </div>
        <input type="submit" value="Submit">
    </form>


    <button onclick="window.location='top10.php'" class="btn btn-warning">Rebríček Top 10 hráčov</button>
    <button onclick="window.location='index.php'" class="btn btn-warning">Rebríček víťazov OH</button>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/sorttable.js"></script>
<script src="js/script.js"></script>
</body>
</html>
<?php
function vyberHraca(){
    include_once("login.php");
    $conn = pokusLogin();

    $stm = $conn->query("select * from person");

    $osoby = $stm->fetchAll(PDO::FETCH_ASSOC);

    echo '<select  name="idOsoba" class="form-select">
    <option value="null">Vyber olympionika</option>';


    foreach ($osoby as $osoba){

        echo '<option value='.$osoba["id"].'>'.$osoba["name"].' '.$osoba["surname"].'</option>';

    }
    echo '</select><br>';




    $stm2 = $conn->query("select * from oh");

    $olympiady = $stm2->fetchAll(PDO::FETCH_ASSOC);

    echo '<select name="idOH" class="form-select" >
    <option value="null">Vyber olympiadu</option>';


    foreach ($olympiady as $oh1){

        echo '<option " value='.$oh1["id"].'>'.$oh1["city"].' '.$oh1["year"].'</option>';

    }
    echo '</select>';



}

function pridajUmiestnenie(){

    include_once("login.php");
    $conn = pokusLogin();
    $stm = $conn->prepare("INSERT INTO placing (person_id, oh_id, placing, discipline) VALUES (?,?,?,?)");
    $stm->bindValue(1,$_POST["idOsoba"]);
    $stm->bindValue(2, $_POST["idOH"]);
    $stm->bindValue(3, $_POST["umiestnenie"]);
    $stm->bindValue(4, $_POST["disciplina"]);
    $stm->execute();

    header('Location:'.'detailHrac.php?hrac='.$_POST["idOsoba"]);
}



?>