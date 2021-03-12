<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="css/dizajn.css">
</head>
<body>

<header>
    <h1>Športovci top10</h1>
</header>
<main class="container">
    <section id="tabulkaGenerovana">

        <?php

        include_once("login.php");
        $conn = pokusLogin();
        $stm = $conn->query("SELECT person.id, person.name,person.surname, COUNT(placing.placing) AS pocet 
                            FROM placing,person where placing.person_id=person.id 
                                                  and placing.placing = 1 
                            group by person.id, person.name, person.surname order by pocet desc limit 10;");

        $top10 = $stm->fetchAll(PDO::FETCH_ASSOC);

        echo '
                <h2>Tabuľka športovcov</h2>
                    <div class="tabulka">
                        <table   class=" table table-striped" id="table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Meno</th>
                                    <th scope="col">Priezvisko</th>
                                    <th scope="col">Počet zlatých medaily</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody >';

        //vytvaranie tabulky top10
        foreach ($top10 as $top1) {
            echo '
                              <tr>
                                <td  class="kurzor" onclick="dostanHraca('.$top1["id"].')">' . $top1["name"] . '</td>
                                <td  class="kurzor" onclick="dostanHraca('.$top1["id"].')">' . $top1["surname"] . '</td>
                                <td>' . $top1["pocet"] . '</td>
                                <td><a class="btn btn-primary" href="update.php?upd='.$top1["id"].'" role="button">Update</a></td>
                              </tr>';

        }


        echo '</tbody>
                        </table>
                    </div>';

        ?>


    </section>
    <br>
    <button onclick="window.location='index.php'" class="btn btn-warning">Rebríček víťazov OH</button>
    <a class="btn btn-success" href="vytvorHraca.php" role="button">Vytvorenie hráča</a>
    <a class="btn btn-success" href="vytvorUmiestnenie.php" role="button">Vytvorenie umiestnenia</a>

</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/sorttable.js"></script>
<script src="js/script.js"></script>
</body>
</html>