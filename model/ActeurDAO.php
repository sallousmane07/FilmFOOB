<?php


namespace model;


class ActeurDAO
{
    private $_db;
    function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb($db){
        $this->_db=$db;
    }
    public function count(){
        return $this->_db->query('SELECT COUNT(*) FROM Acteur')->fetchColumn() or die(print_r($this->_db->errorInfo()));
    }
    public function is_exist(Acteur $Acteur){
        return (bool) $this->_db->query('SELECT COUNT(*) FROM Acteur WHERE id_acteur='.$Acteur->id_acteur())->fetchColumn();
    }
    public function getOne(Acteur $Acteur){
        $q=$this->_db->query('SELECT * from Acteur where id_acteur ='. $Acteur->id_acteur());
        $donnees=$q->fetch(\PDO::FETCH_ASSOC);
        return new Acteur($donnees);
    }
    public function getAll(){
        $Acteurs = [];
        $q = $this->_db->prepare('SELECT * FROM Acteur ');
        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $Acteurs[]= new Acteur($donnees);
            }
        }
        return $Acteurs;
    }
    public function add(Acteur $Acteur){
        $q=$this->_db->prepare('INSERT INTO Acteur(nom,nationalite) VALUES (:nom,:nationalite)')  or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':nom',$Acteur->nom());
        $q->bindvalue(':nationalite',$Acteur->nationalite());
        $q->execute();
        $Acteur->hydrate(['Acteur' => $this->_db->lastInsertId()]);
    }
    public function update(Acteur $Acteur){
        $q=$this->_db->prepare('UPDATE Acteur set nom=:nom, nationalite=:nationalite where id_acteur=:id_acteur') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':nom',$Acteur->nom());
        $q->bindvalue(':nationalite',$Acteur->nationalite());
        $q->bindvalue(':id_acteur',$Acteur->id_acteur());
        $q->execute();
    }
    public function delete(Acteur $Acteur){
        $q=$this->_db->prepare('DELETE from Acteur where id_acteur=:id_acteur') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_acteur',$Acteur->id_acteur());
        $q->execute();
    }

}