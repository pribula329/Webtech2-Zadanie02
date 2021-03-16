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

if (isset($_POST["meno"])){
    postMetoda();
}
?>
<h1>Vytvaranie hráča</h1>
<form action="vytvorHraca.php" method="post">
    <div class="row">
        <div id="lavaStrana" class="col-md-6">
            <br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Meno</span>
                </div>
                <input required type="text" id="meno" class="form-control" name="meno" value="<?php echo isset($update["name"])? $update["name"] : null; ?>">
            </div>
            <br>
            <h2>Údaje o narodení</h2>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Dátum narodenia</span>
                </div>
                <input required type="text" id="datum" class="form-control" name="DN" value="<?php echo isset($update["birth_day"])? $update["birth_day"] : null; ?>">

            </div>
            <small  class="form-text text-muted">Dátum zadávajte vo formate DD.MM.RRRR</small>
            <br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Miesto narodenia</span>
                </div>
                <input required type="text" id="miestoN" class="form-control" name="MN" value="<?php echo isset($update["birth_place"])? $update["birth_place"] : null; ?>">
            </div>
            <br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Krajina narodenia</span>
                </div>
                <input required type="text" id="krajinaN" class="form-control" name="KN" value="<?php echo isset($update["birth_country"])? $update["birth_country"] : null; ?>">
            </div>
            <br>

        </div>

        <div id="pravaStrana" class="col-md-6">
            <br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Priezvisko</span>
                </div>
                <input required type="text" id="priezvisko" class="form-control" name="priezvisko" value="<?php echo isset($update["surname"])? $update["surname"] : null; ?>">
            </div>
            <br>
            <h2>Údaje o úmrtí</h2>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Dátum úmrtia</span>
                </div>
                <input  type="text" id="datumU" class="form-control" name="DU" value="<?php echo isset($update["death_day"])? $update["death_day"] : null; ?>">

            </div>
            <small  class="form-text text-muted">Dátum zadávajte vo formate DD.MM.RRRR</small>
            <br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Miesto úmrtia</span>
                </div>
                <input  type="text" id="miestoU" class="form-control" name="MU" value="<?php echo isset($update["death_place"])? $update["death_place"] : null; ?>">
            </div>
            <br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Krajina úmrtia</span>
                </div>
                <input  type="text" id="krajinaU" class="form-control" name="KU" value="<?php echo isset($update["death_country"])? $update["death_country"] : null; ?>">
            </div>
            <br>
        </div>

    </div>

    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<br>
<button onclick="window.location='top10.php'" class="btn btn-warning">Rebríček Top 10 hráčov</button>
<button onclick="window.location='index.php'" class="btn btn-warning">Rebríček víťazov OH</button>
</body>
</html>

<?php

function postMetoda(){

    $conn = loginMetoda();
    $stm = $conn->prepare("INSERT INTO person (name, surname, birth_day, birth_place, birth_country,
                                    death_day, death_place, death_country) VALUES (?,?,?,?,?,?,?,?)");
    $stm->bindValue(1,$_POST["meno"]);
    $stm->bindValue(2, $_POST["priezvisko"]);
    $stm->bindValue(3, $_POST["DN"]);
    $stm->bindValue(4, $_POST["MN"]);
    $stm->bindValue(5, $_POST["KN"]);
    $stm->bindValue(6, $_POST["DU"]);
    $stm->bindValue(7, $_POST["MU"]);
    $stm->bindValue(8, $_POST["KU"]);
    $stm->execute();

    $idPridaneho = $conn->lastInsertId();

   header('Location:'.'detailHrac.php?hrac='.$idPridaneho);
}

function loginMetoda()
{
    include_once("login.php");
    $conn = pokusLogin();
    return $conn;
}

?>