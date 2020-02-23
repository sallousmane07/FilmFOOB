<?php


namespace model;


class Realisateur
{

    private $_id_realisateur,
        $_nom,
        $_nationalite;

    public function nom()
    {
        return $this->_nom;
    }

    public function id_realisateur()
    {
        return $this->_id_realisateur;
    }

    public function nationalite()
    {
        return $this->_nationalite;
    }

    public function setNationalite($nationalite)
    {
        $this->_nationalite = $nationalite;
    }


    public function setId_realisateur($id_realisateur)
    {
        $id_realisateur = (int)$id_realisateur;
        if (is_int($id_realisateur)) {
            $this->_id_realisateur = $id_realisateur;
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
