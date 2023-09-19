<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    use Model\Managers\CategoryManager;
    
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          
           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll()
                ]
            ];
        
        }


        // Fonction qui permet de voir tout les posts en fesant appel a listPostFromUser qui est une requête sql récupérant tout les posts dans la db
        public function viewAllPost(){

            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR."forum/listPosts.php",
                "data" => [
                    "posts" => $postManager->listPostFromUser()
                ]
            ];
        }


        // Fonction qui permet de voir tout les users en fesant appel a listUser qui est une requête sql récupérant tout les users dans la db
        public function viewAllUser(){

            $userManager = new UserManager();

            return [
                "view" => VIEW_DIR."forum/listUsers.php",
                "data" => [
                    "users" => $userManager->listUser()
                ]
            ];
        }

        // Permet de voir les catégorie en fesant appell a la fonction ListCats qui est une rqt sql qui récup les catégories dans la db.
        public function viewCat(){

            $catManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCats.php",
                "data" => [
                    "cats" => $catManager->listCats()
                ]
            ];
        }


        // Permet de voir chaque topic par catégorie en récuprant les topics par catégorie avec une rqts Sql

        public function viewCatByTopic($id){

            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/detailCat.php",
                "data" => [
                    "topics" => $topicManager->findTopicByCat($id)
                ]
            ];
        }


        // Permet de voir chaque Post par topic en récupérant les topics par catégorie avec une rqts Sql

        public function viewPostFromTopic($id){

            $postManager = new PostManager();
            $topic = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => [
                    "topic" => $topic->findOneById($id),
                    "posts" => $postManager->findPostByTopicId($id)
                ]
            ];
        }

        // function qui appelle la vue addcat qui permet d'ajouter une catégorie

        public function viewAddCat(){

            return [
                "view" => VIEW_DIR."forum/addCat.php"
            ];
        }

        // function permettant d'ajouter une catégorie
        // Filtre les caractères spéciaux

        public function addCat(){

            if(!empty($_POST)){

                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($name && $img){

                    $category = new CategoryManager();
                    $cat = $category->findOneByName($name);

                    if(!$cat){

                        $category->add([
                            "name" => $name, 
                            "img" => $img
                        ]);
                    }
                }

            } 
            return [
                "view" => VIEW_DIR."/forum/addCat.php"
            ];
        }


        // function permettant d'ajouter un topic en filtrant les caractères spéciaux
        public function addTopic($id){

            if (!empty($_POST)){

                $title = filter_input(INPUT_POST,"title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $text = filter_input(INPUT_POST,"text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $cat_id = $_GET['id'];
                $user_id = Session::getUser()->getId();

                if($title){

                    $topic = new TopicManager();
                    $post = new PostManager();

                        $id = $topic->add([
                            "title" => $title, 
                            "category_id" => $cat_id,
                            "user_id" => $user_id
                        ]);

                        $post->add([
                            "text" => $text,
                            "user_id" => $user_id,
                            "topic_id" =>$id
                        ]);
                }
            }
            $this->redirectTo("forum", "viewPostFromTopic", $id);
        }


        // function permettant d'ajouter un post en filtrant les caractères spéciaux

        public function addPost($id){

            if (!empty($_POST)){

                $text = filter_input(INPUT_POST,"text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $id = $_GET['id'];
                $user_id = Session::getUser()->getId();

                if($text){

                    $addPost = new PostManager();
                    $topic = new TopicManager();

                        $addPost->add([
                            "text" => $text, 
                            "topic_id" => $id,
                            "user_id" => $user_id
                        ]);
                     
                }
            } 
            $this->redirectTo("forum", "viewPostFromTopic", $id);
        }


        // Fonction permettant d'accéder a la page pour modifier le post 

        public function viewModify($id){

            $id = $_GET['id'];
            $postManager = new PostManager();
            
            return [
                "view" => VIEW_DIR."forum/modifyElement.php",
                "data" => [
                    "post" => $postManager->findOneById($id)
                ]
            ];
        }


         // Fonction permettant de supprimer un post
        public function deletePost($id){

            $byebye = new PostManager();

            $byebye->delete($id);

            $this->redirectTo("forum", "viewPostFromTopic", $id);
        }

         // Fonction permettant de modifier un post

        public function modifyPost($id){
            $id = $_GET['id'];
            // $topicId = $_GET['topic'];

            if (isset($_POST['submit'])){
                

                $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                
                if($text){
                    
                    $addPost = new PostManager();
                    $topic = new TopicManager();

                    $addPost->updatePost($text, $id);  
                    Session::addFlash("succes", "Commentaire modifié");
                    // $this->redirectTo("forum", "viewPostFromTopic", $topicId);
                    return [
                        "view" => VIEW_DIR."forum/detailTopic.php",
                        "data" => [
                            "topic" => $topic->findOneById($id),
                            "posts" => $addPost->findPostByTopicId($id)
                        ]
                    ];

                } else {
                    Session::addFlash("error", "Un problème avec le contenu");
                }
            }
            Session::addFlash("error", "recommencez") ; 
            // $this->redirectTo("forum", "viewPostFromTopic", $topicId);
        }
    }
