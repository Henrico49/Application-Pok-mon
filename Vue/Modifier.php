<?php
ob_start();
?>
<!-- Création du form avec tout les pokémons-->
    <h1>Modifier Pokémon</h1>
    <form action="" method="POST">
        <p>
            <label for="pokemon">Pokémon : </label>
            <select name="id">

                <?php
                /** @var array $pokeList */
                foreach ($pokeList as $pokemon)
                    {
                        echo "<option value=\"".$pokemon->getid()."\">".$pokemon->getname()."</option>";
                    }
                ?>
            </select>
        </p>
        <p>
            <label for="taille">Taille : </label>
            <input type="number" name="taille" id="taille" required ="1">
        <p>
        <p>
            <label for="poids">Poids : </label>
            <input type="number" name="poids" id="poids" required="1">
        </p>
        <p>
            <input type="submit">
        </p>
    </form>
<?php

?>

<?php
$content = ob_get_clean () ;

require_once('gabarit.php');
?>