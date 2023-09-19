<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\TopicManager;

    class TopicManager extends Manager {

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        // function construct appellant la fonction connect de la class parent
        public function __construct(){
            parent::connect();
        }

        // Seléctionne tout de topic et prend aussi le user pour afficher chaque topic par user en uttilisant une rqdt sql de jointure 
        public function listTopicByUser(){

            $sql = "SELECT *
                    FROM topic t
                    INNER JOIN user u ON t.user_id = u.id_user";

        // Sert a récupérer plusieurs résultats
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        // Récupére les topics associé a la catégory actuelle 
        public function findTopicByCat($id){

            $sql = "SELECT *
                    FROM topic t 
                    WHERE category_id = :id";
         // Sert a récupérer plusieurs résultats
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

    }

