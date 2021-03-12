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
if (isset($_POST["id"])){ //overenie ci je zadany hrac po update
    postMetoda();
    echo 'som post';
}
else if(isset($_GET["upd"])){ //overenie ci je update
    $update = getMetoda();
    echo 'som get';
    }
else { //ak nic tak chyba
    header('Location:'.'../404.html');
}

?>

<form action="update.php" method="post">
    <input  type="hidden" id="id" name="id" value="<?php echo isset($update["id"])? $update["id"] : null; ?>"><br>
<div class="row">
    <div id="lavaStrana" class="col-md-6">
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


    <input type="submit" value="Submit">
</form>
<button onclick="window.location='top10.php'" class="btn btn-warning">Rebríček Top 10 hráčov</button>
<button onclick="window.location='index.php'" class="btn btn-warning">Rebríček víťazov OH</button>
</body>
</html>


<?php
function getMetoda(){


    $conn = loginMetoda();
    $hracUPD = $_GET["upd"];
    $stm = $conn->prepare("select person.id,person.name,person.surname,person.birth_day,person.birth_place,person.birth_country,person.death_day, person.death_place,person.death_country 
                            from person where person.id = ?");
    $stm->bindValue(1, $hracUPD);
    $stm->execute();

    $update = $stm->fetch(PDO::FETCH_ASSOC);
    var_dump($update);
    if ($update==false){
        header('Location:'.'../404.html');
    }
    else{
        return $update;
    }

}

function postMetoda(){

    $conn = loginMetoda();
    var_dump($_POST["id"]);
    $stm = $conn->prepare("UPDATE person SET name=?, surname=?, birth_day=?, birth_place=?, birth_country=?,
                                    death_day=?, death_place=?, death_country=? WHERE person.id=?");
    $stm->bindValue(1,$_POST["meno"]);
    $stm->bindValue(2, $_POST["priezvisko"]);
    $stm->bindValue(3, $_POST["DN"]);
    $stm->bindValue(4, $_POST["MN"]);
    $stm->bindValue(5, $_POST["KN"]);
    $stm->bindValue(6, $_POST["DU"]);
    $stm->bindValue(7, $_POST["MU"]);
    $stm->bindValue(8, $_POST["KU"]);
    $stm->bindValue(9, $_POST["id"]);
    $stm->execute();
    header('Location:'.'detailHrac.php?hrac='.$_POST["id"]);
}

function loginMetoda()
{
    include_once("login.php");
    $conn = pokusLogin();
    return $conn;
}

?>