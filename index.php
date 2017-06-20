<?php 

require_once('Classes/TortankClasse.php');
require_once('Classes/RoucarnageClasse.php');
require_once('Classes/CombatClasse.php');

require_once('template/head.php');
?>

<main>
    <div id="resultat">
        <?php

        $tortank = new Tortank("Tortank", Pokemon::PV_BAS, Pokemon::PUISSANCE_MOYEN);
        $roucarnage = new Roucarnage("Roucarnage", Pokemon::PV_BAS, Pokemon::PUISSANCE_MOYEN);
        $combat = new Combat();

        $combat->full_combat($tortank, $roucarnage);
        ?>
    </div>
</main>

