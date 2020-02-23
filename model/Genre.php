<?php
namespace model;



class Genre
{
    private $_id_genre,
           $_nom_genre;

    public function id_genre()
    {
        return $this->_id_genre;
    }
    public function nom_genre()
    {
        return $this->_nom_genre;
    }

    public function setNom_genre($nom_genre){
        $this->_nom_genre= $nom_genre;
    }

    public function setId_genre($id_genre)
    {
        $id_genre=(int)$id_genre;
        if (is_int($id_genre)) {

            $this->_id_genre=$id_genre;
        }

    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {

            $methode='set'.ucfirst($key);

            if(method_exists($this, $methode))
            {
                $this->$methode($value);
            }
        }
    }
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
}

