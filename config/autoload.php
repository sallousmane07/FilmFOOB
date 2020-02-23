<?php 
class Autoloader
{
    static function register() {
        spl_autoload_register( array(__CLASS__, "autoload") );
    }
    static function autoload($class) {

        try {
            $file_namespace = str_replace("\\", "/", $class.".php");
           // echo $file_namespace;die();
            if (file_exists($file_namespace)) { // src/controller/TestController.php
                require_once $file_namespace;
            }
            else {
                throw new \Exception ('Merci d\'utiliser le mot clé USE avant d\'instancier la classe: '.$class);
            }
        }
        catch (Exception $e) {
            echo' Il y\' une erreur';
            //require_once "src/controller/ErrorHTTPController.php";
        }
    }
}
Autoloader::register(); 
