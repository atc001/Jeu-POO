<?php

require_once('RenduClasse.php');

abstract class Pokemon {
    const PV_BAS = 100;
    const PV_MOYEN = 150;
    const PV_HAUT = 200;

    const PUISSANCE_BAS = 2;
    const PUISSANCE_MOYEN = 4;
    const PUISSANCE_HAUT = 6;

    protected $pv;
    protected $nom;
    protected $puissance;
    protected $rendu;

    public function __construct($nom, $pv, $puissance) {
    $this->set_nom($nom);
    $this->set_pv($pv);
    $this->set_puissance($puissance);
    $this->rendu = Rendu::get_instance();
    }

        public function set_pv($pv) {
        if($pv === Self::PV_BAS || $pv === Self::PV_MOYEN || $pv === Self::PV_HAUT) {
            $this->pv = $pv;
        } else {
            throw new Exception($pv . " n'est pas egal a" . Self::PV_BAS . "||" . Self::PV_MOYEN . "||" . Self::PV_HAUT);
        }
    }

    private function set_nom($nom) {
        $this->nom = $nom;
    }

    public function set_puissance($puissance) {
            if($puissance === Self::PUISSANCE_BAS || $puissance === Self::PUISSANCE_MOYEN || $puissance === Self::PUISSANCE_HAUT) {
            $this->puissance = $puissance;
            } else {
            throw new Exception($puissance . " n'est pas egal a" . Self::PUISSANCE_BAS . "||" . Self::PUISSANCE_MOYEN . "||" . Self::PUISSANCE_HAUT);
            }
    }

    public function get_pv() {
        return $this->pv;
    }

    public function get_nom() {
        return $this->nom;
    }

    public function get_puissance() {
        return $this->puissance;
    }

    public function dommage($enemy) {
        $enemy->blessure($this->get_puissance());
    }

    public function blessure($dommage) {
        $this->pv = $this->get_pv() - $dommage;
    }

    public function ko () {
        if($this->get_pv() > 0) {
            return True;
        } else {
            return False;
        }
    }
}