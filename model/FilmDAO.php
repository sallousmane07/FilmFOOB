<?php
namespace model;

use model\Film;

class FilmDAO
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
        return $this->_db->query('SELECT COUNT(*) FROM Film')->fetchColumn() or die(print_r($this->_db->errorInfo()));
    }
    public function is_exist(Film $Film){
        return (bool) $this->_db->query('SELECT COUNT(*) FROM Film WHERE id_film='.$Film->id_film())->fetchColumn();
    }
    public function getOne($id){
        $id=(int)$id;
        $q=$this->_db->query('SELECT * from Film where id_film ='.$id);
        $donnees=$q->fetch(\PDO::FETCH_ASSOC);
        //var_dump($donnees);
        return new Film($donnees);
    }
    public function getAll(){
        $Films = [];
        $q = $this->_db->prepare('SELECT * FROM Film ');
        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $Films[]= new Film($donnees);
            }
        }
        return $Films;
    }
    public function add(Film $Film){
        $q=$this->_db->prepare('INSERT INTO Film(titre,description,date,id_realisateur) VALUES (:titre,:description,:date,:id_realisateur)')  or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':titre',$Film->nom());
        $q->bindvalue(':description',$Film->description());
        $q->bindvalue(':date',$Film->date());
        $q->bindvalue(':id_realisateur',$Film->id_realisateur());
        $q->execute();
        $Film->hydrate(['Film' => $this->_db->lastInsertId(),]);
    }
    public function update(Film $Film){
        $q=$this->_db->prepare('UPDATE Film set titre=:titre,description=:description,date=:date,id_realisateur=:id_realisateur where id_film=:id_film') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':titre',$Film->nom());
        $q->bindvalue(':description',$Film->description());
        $q->bindvalue(':date',$Film->date());
        $q->bindvalue(':id_realisateur',$Film->id_realisateur());
        $q->bindvalue(':id_film',$Film->id_film());
        $q->execute();
    }
    public function delete(Film $Film){
        $q=$this->_db->prepare('DELETE from Film where id_Film=:id_Film') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_Film',$Film->id_Film());
        $q->execute();
    }
}
