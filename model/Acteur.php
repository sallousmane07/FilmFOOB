<?php


namespace model;


class Acteur
{

    private $_id_acteur,
        $_nom,
        $_nationalite;

    public function nom()
    {
        return $this->_nom;
    }

    public function id_acteur()
    {
        return $this->_id_acteur;
    }

    public function nationalite()
    {
        return $this->_nationalite;
    }

    public function setNationalite($nationalite)
    {
        $this->_nationalite = $nationalite;
    }


    public function setId_acteur($id_acteur)
    {
        $id_acteur = (int)$id_acteur;
        if (is_int($id_acteur)) {
            $this->_id_acteur = $id_acteur;
        }
    }
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $methode = 'set' . ucfirst($key);
            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
}
