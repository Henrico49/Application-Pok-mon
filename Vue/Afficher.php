<?php
ob_start();
?>


<div id=content>
    <h1>Afficher</h1>
    <p>
        <label for="types">Type : </label>
        <select name="id" id ="TypePokemon">
            <!-- choix par défaut -->
            <option value = "0">---</option>
            <?php
            /** @var type $types */
            foreach ($types as $type){
                echo "<option value =".$type->getID().">".$type->getName()."</option>";
            }
            ?>
        </select>
    </p>
    <script src="Public/js/AJAX.js"></script>
    <div id = "TabPokemon">

    </div>
</div>

<?php
$content = ob_get_clean () ;

require_once('gabarit.php');
?>
