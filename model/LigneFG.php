<?php

namespace model;

class LigneFG{
    private $_id_genre;
    private $_id_film;

    public function id_genre(){
        return $this->_id_genre;
    }
    public function setId_genre($id){
        $this->_id_genre=$id;
    }
    public function id_film(){
        return $this->_id_film;
    }
    public function set_Id_film($id){
        $this->_id_film=$id;
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