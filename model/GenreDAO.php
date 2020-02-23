<?php
namespace model;
use model\Genre;

class GenreDAO
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
        return $this->_db->query('SELECT COUNT(*) FROM Genre')->fetchColumn() or die(print_r($this->_db->errorInfo()));
    }
    public function is_exist(Genre $Genre){
        return (bool) $this->_db->query('SELECT COUNT(*) FROM Genre WHERE id_Genre='.$Genre->id_genre())->fetchColumn();
    }
    public function getOne($id){
        $id=(int)$id;
        $q=$this->_db->query('SELECT * from Genre where id_genre ='. $id);
        $donnees=$q->fetch(\PDO::FETCH_ASSOC);
        return new Genre($donnees);
    }
    public function getAll(){
        $Genres = [];
        $q = $this->_db->query('SELECT * FROM Genre');
       // var_dump($q);die();
        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $Genres[]= new Genre($donnees);
            }
        }
        return $Genres;
    }
    public function add(Genre $Genre){
        $q=$this->_db->prepare('INSERT INTO Genre(nom_genre) VALUES (:nom_genre)')  or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':nom_genre',$Genre->nom_genre());
        $Genre->hydrate(['Genre' => $this->_db->lastInsertId(),]);
    }
    public function update(Genre $Genre){
        $q=$this->_db->prepare('UPDATE Genre set nom_genre=:nom_genre where id_genre=:id_genre') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':nom_genre',$Genre->nom_genre());
        $q->execute();
    }
    public function delete(Genre $Genre){
        $q=$this->_db->prepare('DELETE from Genre where id_genre=:id_genre') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_genre',$Genre->id_genre());
        $q->execute();
    }
}
