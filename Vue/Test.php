<?php
ob_start();
/*
 * Affichage du tableau de chaque pokemons et de leurs type
 */

echo '<pre>';
var_dump($pokeTab);
echo '</pre>';
?>


<?php
$content = ob_get_clean () ;

require_once('gabarit.php');
?>