<html lang="fr">
<head>
    <title>Application pokemon-<?= $page ?></title>
    <link href='Public/css/style.css' rel="stylesheet" type="text/css">
</head>
<?php
/*
 * récupération de l'url pour rediriger correctement les pages
 */
$base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$base_url .= "://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
// sauvegarder date et heure zone paris
date_default_timezone_set('Europe/Paris');
$heure = date("H:i:s");
$jour = date("d/m/Y");
?>
<body>
    <header>
        <table>
            <tbody>
            <tr>
                <td><a href="<?php echo("$base_url.?view=index");?>">Accueil</a></td>
                <td><a href="<?php echo("$base_url.?view=test");?>">Test</a></td>
                <td><a href="<?php echo("$base_url.?view=modifier");?>">Modifier Pokémon</a></td>
                <td><a href="<?php echo("$base_url.?view=historisation");?>">Historisation</a></td>
                <td><a href="<?php echo("$base_url.?view=afficher");?>">Afficher Pokémon</a></td>
            </tr>
            </tbody>
        </table>
    </header>

    <?= $content ?>

    <footer>
        <table>
            <tbody><tr>
                <td>Licence 3 Informatique</td>
                <td><?= $jour." ".$heure ?></td>
            </tr>
            </tbody></table>
    </footer>
</body>
</html>
<?php