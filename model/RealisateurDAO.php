<?php


namespace model;
use model\Realisateur;


class RealisateurDAO
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
        return $this->_db->query('SELECT COUNT(*) FROM Realisateur')->fetchColumn() or die(print_r($this->_db->errorInfo()));
    }
    public function is_exist(Realisateur $Realisateur){
        return (bool) $this->_db->query('SELECT COUNT(*) FROM Realisateur WHERE id_realisateur='.$Realisateur->id_realisateur())->fetchColumn();
    }
    public function getOne($id){
        $q=$this->_db->query('SELECT * from Realisateur where id_realisateur ='.$id);
        $donnees=$q->fetch(\PDO::FETCH_ASSOC);
        return new Realisateur($donnees);
    }
    public function getAll(){
        $Realisateurs = [];
        $q = $this->_db->prepare('SELECT * FROM Realisateur ');
        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $Realisateurs[]= new Realisateur($donnees);
            }
        }
        return $Realisateurs;
    }
    public function add(Realisateur $Realisateur){
        $q=$this->_db->prepare('INSERT INTO Realisateur(nom,nationalite) VALUES (:nom,:nationalite)')  or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':nom',$Realisateur->nom());
        $q->bindvalue(':nationalite',$Realisateur->nationalite());
        $Realisateur->hydrate(['Realisateur' => $this->_db->lastInsertId()]);
    }
    public function update(Realisateur $Realisateur){
        $q=$this->_db->prepare('UPDATE Realisateur set nom=:nom, nationalite=:nationalite where id_realisateur=:id_realisateur') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':nom',$Realisateur->nom());
        $q->bindvalue(':nationalite',$Realisateur->nationalite());
        $q->bindvalue(':id_realisateur',$Realisateur->id_realisateur());
        $q->execute();
    }
    public function delete(Realisateur $Realisateur){
        $q=$this->_db->prepare('DELETE from Realisateur where id_realisateur=:id_realisateur') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_realisateur',$Realisateur->id_realisateur());
        $q->execute();
    }

}