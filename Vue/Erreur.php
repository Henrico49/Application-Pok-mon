<?php
ob_start();
/*
 * Affichage du message d'erreur
 */
echo("
<div id =\"erreur\">
    <h1>Erreur : $erreur </h1>
</div>
");
?>

<?php
$content = ob_get_clean () ;

require_once('gabarit.php');
?><?php
