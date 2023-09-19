<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\PostManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";

        // function construct appellant la fonction connect de la class parent
        public function __construct(){
            parent::connect();
        }

        // Function qui récupére chaque post qui vienne d'un user
        public function listPostFromUser(){

            $sql = "SELECT *
                    FROM post p
                    INNER JOIN user u ON p.user_id = u.id_user";

        // Sert a récupérer plusieurs résultats
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        // Sert a récupérer un post par son id

        public function findPostById($id){

            $sql = "SELECT *
                    FROM post p
                    INNER JOIN topic t ON t.id_topic = p.topic_id
                    WHERE p.id_post = :id
                    ";

        // Sert a récupérer plusieurs résultats

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

        // Sert a trouver les post relier a un topic avec l'id du topic 

        public function findPostByTopicId($id){

            $sql = "SELECT *
                    FROM post p
                    WHERE topic_id = :id";

             // Sert a récupérer plusieurs résultats
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }


        // Sert a mettre un jout le texte d'un messager(post)dans la bdd
        public function updatePost($text, $id){

            $sql = "UPDATE post p
                    SET p.text = :text
                    WHERE p.id_post = :id";

            return DAO::update($sql, ['text' => $text ,'id' => $id]);
        }

    }