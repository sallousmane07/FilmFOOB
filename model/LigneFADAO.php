<?php


namespace model;
use model\Acteur;
use model\Film;

class LigneFADAO
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
        return $this->_db->query('SELECT COUNT(*) FROM LigneFA')->fetchColumn() or die(print_r($this->_db->errorInfo()));
    }
    public function getAllFilmByActeur(){
        return  $this->_db->query('SELECT * FROM LigneFA GROUP BY id_acteur') or die(print_r($this->_db->errorInfo()));
    }
    ///recupere tous les nom_Acteur d'un film
    ///
    // recupere tous les objets Acteurs d'un film;
    public function getAllActeurOfOneFilm($id){
        $q = $this->_db->query('SELECT LigneFA.id_acteur, Acteur.nom, Acteur.nationalite
                                FROM LigneFA, Acteur
                                where Acteur.id_acteur=LigneFA.id_acteur and LigneFA.id_film='.$id);
        $Acteurs=[];
        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $Acteurs[]= new Acteur($donnees);
            }
        }
        return $Acteurs;
    }

    public function getAll(){
        $LigneFAs = [];
        $q = $this->_db->prepare('SELECT * FROM LigneFA ');
        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $LigneFAs[]= new LigneFA($donnees);
            }
        }
        return $LigneFAs;
    }
    public function add(LigneFA $LigneFA){
        $q=$this->_db->prepare('INSERT INTO LigneFA(id_Acteur,id_film) VALUES (:id_Acteur,:id_film')  or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_Acteur',$LigneFA->id_Acteur());
        $q->bindvalue(':id_film',$LigneFA->id_film());

    }
    public function update(LigneFA $LigneFA){
        $q=$this->_db->prepare('UPDATE LigneFA set id_Acteur=:id_Acteur,id_film=:id_film where id_Acteur=:id_Acteur') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_Acteur',$LigneFA->id_Acteur());
        $q->bindvalue(':id_film',$LigneFA->id_film());
        $q->execute();
    }
    public function delete(LigneFA $LigneFA){
        $q=$this->_db->prepare('DELETE from LigneFA where id_Acteur=:id_Acteur') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_LigneFA',$LigneFA->id_Acteur());
        $q->execute();
    }
}