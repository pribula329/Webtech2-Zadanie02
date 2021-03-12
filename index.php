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
    <h1>Športovci</h1>
</header>
<main class="container">
    <section id="tabulkaGenerovana">

        <?php

        include_once("login.php");
        $conn = pokusLogin();

        $stm = $conn->query("select person.id,person.name,person.surname,oh.year,oh.city,oh.type, placing.discipline 
                            from person,oh,placing where person.id = placing.person_id 
                                                     and placing.oh_id = oh.id 
                                                     and placing.placing=1;");

        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
        include "generovanieTabulky.php";
        generovanieTabulky($rows);



        ?>


    </section>
    <br>
    <button onclick="window.location='top10.php'" class="btn btn-warning">Rebríček Top 10 hráčov</button>
    <a class="btn btn-success" href="vytvorHraca.php" role="button">Vytvorenie hráča</a>
    <a class="btn btn-success" href="vytvorUmiestnenie.php" role="button">Vytvorenie umiestnenia</a>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/sorttable.js"></script>
<script src="js/script.js"></script>
</body>
</html>


