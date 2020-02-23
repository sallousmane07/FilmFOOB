<?php
    $bd = connexion();
    require 'config/autoload.php';
    require 'vendor/autoload.php';
    $twig = chargerTwig();
    use Twig\Environment as Environment;
    use Twig\Loader\FilesystemLoader as FilesystemLoader;

    function connexion(){

        try {
           $bdd = new PDO('mysql:host=localhost;dbname=annuairefilm;charset=utf8', 'root', '');
           return $bdd;
        }
        catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

    }

    function chargerTwig(){
    $loader = new FilesystemLoader('view');
     return new Environment($loader, [
        'cache' => false,
    ]);
    }
require 'controller/controller.php';



//    $json = file_get_contents('config/connectBase.json');
//////    $json_data = json_decode($json, true);
//////    $mysql_film = $json_data["mysql-film"];
//////    $url = $mysql_film['database'] . ':host=' . $mysql_film['host'] . ';dbname=' . $mysql_film['name'] . ';port=' . $mysql_film['port'] . ';charset=utf8';
//////    return new PDO ($url, $mysql_film['user'], $mysql_film['pwd']);