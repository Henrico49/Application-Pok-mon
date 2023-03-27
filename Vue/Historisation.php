<?php
ob_start();
?>
<div id="content">
<h1>Historisation des opérations modifiant la base</h1>

<h2>Modifier</h2>
<table>
    <thead>
    <tr>
        <th>Horodatage</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($xml->operation as $operation) {
        if($operation->type =="Modifier"){
            echo("<tr> <td>$operation->horodate</td><td>$operation->desc </td> </tr>");
        }

    }
    ?>

    </tbody>
</table>
<h2>Voir</h2>
    <table>
        <thead>
        <tr>
            <th>Horodatage</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($xml->operation as $operation) {
            if($operation->type =="Voir"){
                echo("<tr> <td>$operation->horodate</td> <td>$operation->desc</td> </tr>");
            }

        }
        ?>
        </tbody>
    </table>
<h2>Autre</h2>
    <table>
        <thead>
        <tr>
            <th>Horodatage</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($xml->operation as $operation) {
            if($operation->type =="other"){
                echo("<tr> <td>$operation->horodate</td><td>$operation->desc </td> </tr>");
            }

        }
        ?>
        </tbody>
    </table>
</div>
<?php

$content = ob_get_clean () ;

require_once('gabarit.php');
?>
