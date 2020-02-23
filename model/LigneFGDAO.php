<?php
namespace model;
use model\Genre;
use model\Film;
use model\GenreDAO;



class LigneFGDAO
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
        return $this->_db->query('SELECT COUNT(*) FROM LigneFG')->fetchColumn() or die(print_r($this->_db->errorInfo()));
    }
    public function getAllFilmByOneGenre($id){
           $q=$this->_db->query('SELECT f.id_film,f.titre,f.description,f.date,f.id_realisateur 
                                    from film f join lignefg l 
                                    on l.id_film=f.id_film 
                                    where id_genre='.$id) or die(print_r($this->_db->errorInfo()));
        $Films=[];
        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $Films[]= new Film($donnees);
            }
        }
        return $Films;
    }

    ///recupere tous les nom_genre d'un film
    ///
    // recupere tous les objets genres d'un film;
    public function getAllGenreOfOneFilm($id){
        $q = $this->_db->query('SELECT LigneFG.id_genre, nom_genre 
                                FROM LigneFG, Genre 
                                where Genre.id_genre=LigneFG.id_genre and LigneFG.id_film='.$id);
        $Genres=[];
        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $Genres[]= new Genre($donnees);
            }
        }
        return $Genres;
    }
    public function getAll(){
        $LigneFGs = [];
        $q = $this->_db->prepare('SELECT * FROM LigneFG ');
        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $LigneFGs[]= new LigneFG($donnees);
            }
        }
        return $LigneFGs;
    }
    public function add(LigneFG $LigneFG){
        $q=$this->_db->prepare('INSERT INTO LigneFG(id_genre,id_film) VALUES (:id_genre,:id_film')  or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_genre',$LigneFG->id_genre());
        $q->bindvalue(':id_film',$LigneFG->id_film());
        $q->execute();

    }
    public function update(LigneFG $LigneFG){
        $q=$this->_db->prepare('UPDATE LigneFG set id_genre=:id_genre,id_film=:id_film where id_genre=:id_genre') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_genre',$LigneFG->id_genre());
        $q->bindvalue(':id_film',$LigneFG->id_film());
        $q->execute();
    }
    public function delete(LigneFG $LigneFG){
        $q=$this->_db->prepare('DELETE from LigneFG where id_genre=:id_genre') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_LigneFG',$LigneFG->id_genre());
        $q->execute();
    }
}





/*
  public function getAllFilmByGenre(){
       $q=$this->_db->query('select * from lignefg l join film f on l.id_film=f.id_film join genre g on l.id_genre=g.id_genre ORDER BY g.id_genre') or
       die(print_r($this->_db->errorInfo()));
        $GenreFilms=[];
        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $GenreFilms[]= $donnees;
            }
            //var_dump($GenreFilms);
        }
        $tab=[];
        $name_genre='';
        if(count($GenreFilms)>0){
            $sous_tab=[];
            $name_genre=$GenreFilms[0]['nom_genre'];
            foreach ($GenreFilms as $index => $item) {
                if( ($GenreFilms[$index]['nom_genre'] != $name_genre) || ($index== (count($GenreFilms)-1))){
                    $tab[$name_genre]=$sous_tab;
                    $sous_tab=[];
                    $name_genre= $GenreFilms[$index]['nom_genre'];
                }
                $sous_tab = new Film($GenreFilms[$index]);
            }


        }
        return $tab;
    }
 * */