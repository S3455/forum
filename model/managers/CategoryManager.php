<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";


        // function construct appellant la fonction connect de la class parent
        public function __construct(){
            parent::connect();
        }

        // Fonction list cats permettant de récupérer toutes les catégories pour appeller la fonction plus tard 

        public function listCats(){

            $sql = "SELECT *
                    FROM category c";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        // Fonction qui récupére une entités spécifique dans la bdd et elle renvoie un objet de cette entité sinon elle renvoie null

        public function findOneByName($data){

            $sql = "SELECT *
            FROM ".$this->tableName." u
            WHERE name = :name";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['name' => $data], false), 
                $this->className
            );
        }


        // Recupére une liste de sujets associé a une category 
        public function findCatTopic($id){

            $sql = "SELECT *
                    FROM category c 
                    INNER JOIN topic t ON c.id_category = t.category_id
                    WHERE id_category = :id";


        // Sert a récupérer plusieurs résultats
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        
    }