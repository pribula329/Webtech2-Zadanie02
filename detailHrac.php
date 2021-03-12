<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dizajn.css">

</head>
<body class="container">

<?php

$hrac = $_GET["hrac"];
//overenie ci je zadany hrac
if(!isset($_GET["hrac"])){
    header('Location:'.'../404.html');
}

include_once("login.php");
$conn = pokusLogin();

$stm = $conn->query("select * from person");


$detail = $stm->fetchAll(PDO::FETCH_ASSOC);
$existuje = 0;
foreach ($detail as $jeden) {

    if ($jeden["id"] == $hrac) {
        $existuje = 1;
        echo '<h1>' . $jeden["name"] . " " . $jeden["surname"] . '</h1><br>';
        echo '<div class="row">
                <div class="col" id="lavaStrana">
                    <p>Datum narodenia: ' . $jeden["birth_day"] . '</p><br>
                    <p>Miesto narodenia: ' . $jeden["birth_place"] . '</p><br>
                    <p>Krajina narodenia: ' . $jeden["birth_country"] . '</p><br>
                </div>
                <div class="col" id="pravaStrana">
                    <p>Datum umrtia: ' . $jeden["death_day"] . '</p><br>
                    <p>Miesto umrtia: ' . $jeden["death_place"] . '</p><br>
                    <p>Krajina umrtia: ' . $jeden["death_country"] . '</p><br>
                </div>
                
                
                
             </div>';
        break;
    }


}
//ak neexistuje hrac s takym id
if ($existuje!=1){
    header('Location:'.'../404.html');

}
echo '
                <h2>Výsledky športovca</h2>
                    <div class="tabulkaDetail">
                        <table   class=" table table-striped" id="table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Disciplína</th>
                                    <th scope="col">Umiestnenie</th>
                                    <th scope="col">Mesto OH</th>
                                    <th scope="col">Krajina OH</th>
                                    <th scope="col">Rok konania OH</th>
                                </tr>
                            </thead>
                            <tbody >';
$stm = $conn->query("select person.id,person.name,person.surname,person.birth_day,person.birth_place,person.birth_country,person.death_day, person.death_place,person.death_country, 
                            oh.year,oh.city,oh.country, placing.discipline, placing.placing
                            from person,oh,placing where person.id = placing.person_id
                                                     and placing.oh_id = oh.id ");
$detail = $stm->fetchAll(PDO::FETCH_ASSOC);
foreach ($detail as $jeden) {

    if ($jeden["id"] == $hrac) {
                            echo '<tr>
                                    <td>' . $jeden["discipline"] . '</td>
                                    <td>' . $jeden["placing"] . '. miesto</td>
                                    <td>' . $jeden["city"] . '</td>
                                    <td>' . $jeden["country"] . '</td>
                                    <td>' . $jeden["year"] . '</td>
                                  </tr>';
    }

}


                        echo '</tbody>
                        </table>
                    </div>';
?>

<button onclick="window.location='top10.php'" class="btn btn-warning">Rebríček Top 10 hráčov</button>
<button onclick="window.location='index.php'" class="btn btn-warning">Rebríček víťazov OH</button>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/sorttable.js"></script>
<script src="js/script.js"></script>
</body>
</html>