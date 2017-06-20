<?php

require_once('RenduClasse.php');

class Combat {

    private $tour = 0;
    private $rendu;

    public function __construct() {
        $this->rendu = Rendu::get_instance();
    }

    public function initiative() {
        $rand1 = rand(1, 1000);
        $rand2 = rand(1, 1000);
        if($rand1 > $rand2) {
            //Joueur 1 joue en premier
            return 1;
        } else if($rand1 < $rand2) {
            //Joueur 2 joue en premier
            return 2;
        } else {
            //Initiative a gerer
            return False;
        }
    }

    public function combat_tour($tortank, $roucarnage) {

        $tortank_nom = $tortank->get_nom();
        $roucarnage_nom = $roucarnage->get_nom();
        $tortank_pv = $tortank->get_pv();
        $roucarnage_pv = $roucarnage->get_pv();

        $initiative = $this->initiative();

        echo "<div class='tour'>";
        switch($initiative) {
            case 1:
                $rand = rand(1, 2);
                if($rand == 1) {
                    $this->rendu->message($tortank_nom . " attaque pistolet à eau sur " . $roucarnage_nom);
                    $tortank->dommage($roucarnage);
                    $this->rendu->autre("Les pv de " . $roucarnage_nom . " tombe à " . $roucarnage_pv);
                } else if($rand == 2) {
                    $this->rendu->message($tortank_nom . " utilise hydraucanon sur " . $roucarnage_nom);
                    $tortank->dommage_bis($roucarnage);
                    $this->rendu->autre("Les pv de " . $roucarnage_nom . " tombe à " . $roucarnage_pv);
                }
                break;

            case 2:
                $rand = rand(1, 2);
                if($rand == 1) {
                    $this->rendu->message($roucarnage_nom . " invoque une tornade sur " . $tortank_nom);
                    $roucarnage->dommage($tortank);
                    $this->rendu->autre("Les pv de " . $tortank_nom . " tombe à " . $tortank_pv);
                } else if($rand == 2) {
                    $this->rendu->message($roucarnage_nom . " s'élève dans le ciel pour effectuer aéropique sur " . $tortank_nom);
                    $roucarnage->dommage_bis($tortank);
                    $this->rendu->autre("Les pv de " . $tortank_nom . " tombe à " . $tortank_pv);
                }
                break;

            case False:
                break;
            
            default:
                throw new Exception("Erreur lors de l'initiative" . $initiative);
                break;
        }
        echo "</div>";
    }

    public function full_combat($tortank, $roucarnage) {
        while (True) {
            $this->combat_tour($tortank, $roucarnage);
            if($tortank->ko() == False && $roucarnage->ko() == True) {
                $this->rendu->success('Roucarnage a gagné');
                return True;
            } else if($tortank->ko() == True && $roucarnage->ko() == False) {
                $this->rendu->success('Tortank a gagné');
                return True;
            } else if($tortank->ko() == False && $roucarnage->ko() == False) {
                $this->rendu->autre('Match Nul');
                return True;
            } else if($tortank->ko() == True && $roucarnage->ko() == True) {
                $this->tour = $this->tour + 1;
            }
        }
    }
}