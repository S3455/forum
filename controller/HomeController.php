<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class HomeController extends AbstractController implements ControllerInterface{

        public function index(){
            
           
                return [
                    "view" => VIEW_DIR."home.php"
                ];
            }
            
        // function qui récupère les users.
   
        public function users(){
            $this->restrictTo("ROLE_USER");

            $manager = new UserManager();
            $users = $manager->findAll(['registerdate', 'DESC']);

            return [
                "view" => VIEW_DIR."security/users.php",
                "data" => [
                    "users" => $users
                ]
            ];
        }

        // Fonction qui fait une vue qui est rules.php

        public function forumRules(){
            
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }
    }
