<?php
function generovanieTabulky($hodnoty)
{
    echo '
<h2 id="gen">Tabuľka športovcov</h2>
<div class="tabulka">
<table   class="table table-striped" id="table1">
<thead class="table-dark">
    <tr>
    <th scope="col" >Meno</th>
    <th scope="col">Priezvisko</th>
    <th scope="col">Rok získania medaily</th>
    <th scope="col">Miesto konania OH</th>
    <th scope="col">Typ OH</th>
    <th scope="col">Disciplína</th>
    <th scope="col"></th>
    <th scope="col"></th>
    </tr>
</thead>
<tbody >';

    //vytvaranie tabulky vitazov
    foreach ($hodnoty as $hodnota)
    {

        echo '<tr>
                <td class="kurzor" onclick="dostanHraca('.$hodnota["id"].')">'.$hodnota["name"]. '</td>
                <td class="kurzor" onclick="dostanHraca('.$hodnota["id"].')">'.$hodnota["surname"]. '</td>
                <td>'.$hodnota["year"]. '</td>
                <td>'.$hodnota["city"]. '</td>
                <td>'.$hodnota["type"]. '</td>
                <td>'.$hodnota["discipline"]. '</td>
                <td><a class="btn btn-primary" href="update.php?upd='.$hodnota["id"].'" role="button">Update</a></td>
                <td><a class="btn btn-danger" href="delete.php?del='.$hodnota["id"].'" role="button">Delete</a></td>
              </tr>';

    }



    echo '</tbody>
</table>
</div>
';
}