<?php
    use model\FilmDAO;
    use model\LigneFGDAO;
    use model\LigneFADAO;
    use model\RealisateurDAO;


    $daofilm=new FilmDAO($bd);
    $daolfg= new LigneFGDAO($bd);
    $daolfa=new LigneFADAO($bd);
    $daoR=new RealisateurDAO($bd);

    if(isset($_GET['idfilm'])){
        $id=$_GET['idfilm'];
        $film= $daofilm->getOne($id);
        $allgenre=$daolfg->getAllGenreOfOneFilm($id);
        $allacteur=$daolfa->getAllActeurOfOneFilm($id);
        $realisateur=$daoR->getOne($film->id_realisateur());

       echo $twig->render('accueil.html',['film' => $film,'genres'=>$allgenre,'acteurs'=>$allacteur,'realisateur'=>$realisateur ]);
    }