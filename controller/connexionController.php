<?php
    use model\User;
    use model\UserDAO;
    $message='';
    if(isset($_POST['connexion'])){
        $donnees['login']=$_POST['login'];
        $donnees['mdp']=$_POST['mdp'];
        $user=new User($donnees);
        $daoUser=new UserDAO($bd);
        if($daoUser->verifieConnexion($user)!=null){
            session_start();
            $_SESSION['User_connect']=$daoUser->verifieConnexion($user);
            //var_dump($_SESSION['User_connect']);die();
              require('accueilController.php');
        }
        else{
            $message.='Kholatal lougua bine si login wala mot de passe ';
            echo $twig->render('connexion.html',['message'=>$message]);
        }

    }
    elseif(isset($_POST['deconnexion'])){
        session_destroy();
        echo $twig->render('connexion.html',['message'=>$message]);
    }
    else
        echo $twig->render('connexion.html',['message'=>$message]);


