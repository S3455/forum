<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\UserManager;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        // function construct appellant la fonction connect de la class parent
        public function __construct(){
            parent::connect();
        }


        // Fonction qui récupére une entités spécifique dans la bdd et elle renvoie un objet de cette entité sinon elle renvoie null
        public function findOneByNickname($data){

            $sql = "SELECT *
            FROM ".$this->tableName." u
            WHERE u.nickname = :nickname";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['nickname' => $data], false), 
                $this->className
            );
        }

        // Séléctionne les users ce qui permet par la suite de faire un input permettant d'afficher la liste des users en l'appellant 

        public function listUser(){

            $sql = "SELECT *
                    FROM user u";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        } 
    }