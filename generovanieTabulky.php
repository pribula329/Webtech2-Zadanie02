<?php
function generovanieTabulky($hodnoty)
{
    echo '
<h2>Tabuľka športovcov</h2>
<div class="tabulka">
<table   class=" table table-striped" id="table">
<thead class="table-dark">
    <tr>
    <th scope="col">Meno</th>
    <th scope="col">Priezvisko</th>
    <th scope="col">Rok získania medaily</th>
    <th scope="col">Miesto konania OH</th>
    <th scope="col">Typ OH</th>
    <th scope="col">Disciplína</th>
    </tr>
</thead>
<tbody >';

    //vytvaranie tabulky podla honot
    foreach ($hodnoty as $hodnota)
    {

        echo '<tr>
                <td onclick="dostanHraca('.$hodnota["id"].')">'.$hodnota["name"]. '</td>
                <td>'.$hodnota["surname"]. '</td>
                <td>'.$hodnota["year"]. '</td>
                <td>'.$hodnota["city"]. '</td>
                <td>'.$hodnota["type"]. '</td>
                <td>'.$hodnota["discipline"]. '</td>
              </tr>';

    }



    echo '</tbody>
</table>
</div>
';
}