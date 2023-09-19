<?php
    namespace App;

    class Session{

        private static $categories = ['error', 'success'];

        /**
        *   add un msg dans categorie
        */
        public static function addFlash($categ, $msg){
            $_SESSION[$categ] = $msg;
        }

        /**
        *   envoie un mess dans categorie si il y ' en a un 
        */
        public static function getFlash($categ){
            
            if(isset($_SESSION[$categ])){
                $msg = $_SESSION[$categ];  
                unset($_SESSION[$categ]);
            }
            else $msg = "";
            
            return $msg;
        }

        /**
        *   Maintient la connexion tant que il y a un user
        */
        public static function setUser($user){
            $_SESSION["user"] = $user;
        }

        public static function getUser(){
            return (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
        }


        // Fonction qui est appelée pour dire que sa s'applique uniquement si l'user en session est admin.
        public static function isAdmin(){
            if(self::getUser() && self::getUser()->hasRole("[ROLE_ADMIN]")){
                return true;
            }
            return false;
        }

    }