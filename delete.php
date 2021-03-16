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


//overenie ci je zadany hrac
if(!isset($_GET["del"])){
    header('Location:'.'../404.html');
}

include_once("login.php");
$conn = pokusLogin();
$stm = $conn->prepare("Delete from person where person.id = ? ");
$stm->bindValue(1,$_GET["del"]);

$stm->execute();


header('Location:'.'index.php');


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