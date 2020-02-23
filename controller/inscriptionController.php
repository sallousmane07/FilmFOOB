<?php
    //bonjour vava
    use model\UserDAO;
    use model\User;

    $daoUser=new UserDAO($bd);
    if(isset($_POST['inscription'])){
        $donnees=[];
        $donnees["login"] =$_POST['login'];// $_POST["login"];;
        $donnees["mdp"]= $_POST["mdp"];
        $donnees["prenom"]= $_POST["prenom"];
        $donnees["nom"]= $_POST["nom"];

           //
        //var_dump($prenom);die();
        //var_dump($donnees);die();

        $user=new User($donnees);
        if($daoUser->is_exist($user)){
            echo 'Ce login a ete deja choisi';die();
        }
        elseif($daoUser->add($user)){
           echo 'l insertion c est bien passé<br>';
           echo $user->id_user();

       }
        var_dump($user);
       $user->setEstadmin();
        echo $daoUser->update($user);
       var_dump($user);die();
        echo $twig->render('connexion.html');
    }
    else
        echo 'erreur';

    echo $twig->render('inscription.html');


