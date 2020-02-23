<?php
namespace model;

class User
{
    private $_id_user,
        $_nom,
        $_prenom,
        $_login,
        $_estadmin,
        $_mdp;

    public function id_user()
    {
        return $this->_id_user;
    }
    public function nom(){
        return $this->_nom;
    }
    public function prenom(){
        return $this->_prenom;
    }
    public function login(){
        return $this->_login;
    }
    public function mdp(){
        return $this->_mdp;
    }
    public function estadmin(){
        return $this->_estadmin;
    }
    public function setId_user($id_user)
    {
        $id_user=(int)$id_user;
        $this->_id_user=$id_user;
    }
    public function setNom($nom){
        $this->_nom=$nom;
    }
    public function setPrenom($prenom){
        $this->_prenom=$prenom;
    }
    public function setMdp($mdp){
        $this->_mdp=$mdp;
    }
    public function setEstadmin($Ea=1){
        $Ea=(int)$Ea;
        $this->_estadmin=$Ea;
    }
    public function setLogin($login){
        $this->_login=$login;
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
