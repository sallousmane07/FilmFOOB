<?php
namespace model;



/**
 * @method nom()
 */
class Film
{
    private $_id_film,
        $_titre,
        $_date,
        $_description,
        $_id_realisateur;

    public function id_film()
    {
        return $this->_id_film;
    }
    public function description()
    {
        return $this->_description;
    }
    public function titre(){
        return $this->_titre;
    }

    public function id_realisateur()
    {
        return $this->_id_realisateur;
    }
    public function date(){
        return $this->_date;
    }
    public function setDate($date){
        $this->_date= $date;
    }
    public function setDescription($date){
        $this->_description= $date;
    }

    public function setId_film($id_film)
    {
        $id_film=(int)$id_film;
        if (is_int($id_film)) {
            $this->_id_film=$id_film;
        }

    }
    public function setTitre($titre){
        $this->_titre=$titre;
    }

    public function setId_realisateur($titre){
        $this->_id_realisateur=$titre;
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
