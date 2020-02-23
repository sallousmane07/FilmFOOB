<?php


namespace model;


class UserDAO
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
        return $this->_db->query('SELECT COUNT(*) FROM User')->fetchColumn() or die(print_r($this->_db->errorInfo()));
    }
    public function verifieConnexion(User $User){
        $q =  $this->_db->prepare('SELECT *
                                   FROM User 
                                   WHERE login = :login and mdp =:mdp');
        $q->bindvalue(':login',$User->login());
        $q->bindvalue(':mdp',$User->mdp());
        $q->execute();
        if($q){
            $donnees=$q->fetch(\PDO::FETCH_ASSOC);
            if(!$donnees)
                return null;
            return new User($donnees);
        }
        return null;

    }
    public function is_exist(User $User){
        $q =  $this->_db->prepare('SELECT COUNT(*) 
                                   FROM User 
                                   WHERE login = :login');
        $q->bindvalue(':login',$User->login());
        $q->execute();
        return (bool) $q->fetchColumn();
    }
    public function getOne($id){
        $id=(int)$id;
        $q=$this->_db->query('SELECT * from User where id_user ='. $id);
        $donnees=$q->fetch(\PDO::FETCH_ASSOC);
        return new User($donnees);
    }
    public function getAll(){
        $Users = [];
        $q = $this->_db->prepare('SELECT * FROM User ');

        if ($q) {
            while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
            {
                $Users[]= new User($donnees);
            }
        }
        return $Users;
    }
    public function add(User $User){
        $q=$this->_db->prepare('INSERT INTO User(prenom,nom,login,mdp)
                                VALUES (:prenom,:nom,:login,:mdp)')
                                or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':nom',$User->nom());
        $q->bindvalue(':prenom',$User->prenom());
        $q->bindvalue(':login',$User->login());
        $q->bindvalue(':mdp',$User->mdp());
        //$q->bindvalue(':estadmin',$User->estadmin());
        //$User->hydrate(['User' => $this->_db->lastInsertId()]);
       $bool=$q->execute();
            // var_dump($this->_db->lastInsertId());die();
        $User->setId_user($this->_db->lastInsertId());


    }
    public function update(User $User){
        $q=$this->_db->prepare('Update User set prenom=:prenom,nom=:nom,login=:login,mdp=:mdp,estadmin=:estadmin where id_user=:id_user') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':nom',$User->nom());
        $q->bindvalue(':prenom',$User->prenom());
        $q->bindvalue(':login',$User->login());
        $q->bindvalue(':mdp',$User->mdp());
        $q->bindvalue(':estadmin',$User->estadmin());
        $q->bindvalue(':id_user',$User->id_user());
        return $q->execute();
    }
    public function delete(User $User){
        $q=$this->_db->prepare('DELETE from User where id_user=:id_user') or die(print_r($this->_db->errorInfo()));
        $q->bindvalue(':id_user',$User->id_user());
        $q->execute();
    }
}