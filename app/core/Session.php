<?php
namespace App\Core;

class Session {
    private static ?Session $instance=null;

    protected function __construct(){
        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }
    }
    public static function getInstance(){
        if(self::$instance===null){
             self::$instance= new Session();
        }
        return self::$instance ;
    }
    
    public static function set($key,$valeur){
        $_SESSION[$key]=$valeur;
    }
    public static function get($key){
        return isset($_SESSION[$key])?$_SESSION[$key]: null;
    }

    public static function has($key){
        return isset($_SESSION[$key]);
    }
    public static function all(){
        return $_SESSION;
    }
     
    public static function destroy() {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }
}
