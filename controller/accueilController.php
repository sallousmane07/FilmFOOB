<?php
//var_dump($bd);

// j'appelle les classes via leurs controller
use model\FilmDAO;
use model\Film;
use model\Genre;
use model\GenreDAO;
use model\LigneFGDAO;


$daogenre=new GenreDAO($bd);
$daofilm=new FilmDAO($bd);
$daolfg=new LigneFGDAO($bd);
$genres=$daogenre->getAll();
$genrefilms=[];
foreach ($genres as $genre) {
    $genrefilms[$genre->nom_genre()]=$daolfg->getAllFilmByOneGenre($genre->id_genre());
}
$f=$daolfg->getAllFilmByOneGenre(2);
echo '<pre>';
var_dump($genrefilms);
echo '</pre>';








//    echo 'je suis l accueil';
// $filmdao= new FilmDAO($bd);
//
// var_dump($filmdao->getOne(2));
//
//$q = $bd->query('SELECT * FROM acteur ');
//$donnees = $q->fetch(\PDO::FETCH_ASSOC);
//var_dump($donnees);die();
