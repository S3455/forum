<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){
            
           
        }


// Fonction qui permet d'acceder a la vue register
        public function registerForm(){

            return [
                "view"=> VIEW_DIR."/security/register.php",
                "data" => null,
            ];
        }


            
        public function register(){ //fonction pour se register 

            if(!empty($_POST)){ // si ce n'est pas vide faire

                $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // Filtre les données arrivantes dans l'input nickname
                $password = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, array(
                    "options" => array("regexp" => '/[A-Za-z0-9]{12,32}/')));
                // Filtre les données arrivantes dans l'input nickname    
                // expressions réguliere regex permettant de limiter les possiblités de mot de passe en ayant que des maj et min, des chiffres de 0 a 9 et un mot de passe de min 12 et max 32 caractères 
                $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // filtre le formulaire de la confirmation du password
                $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                // Filtre la case email

                if($nickname && $password && $mail){ // si les infos ont été confirmer correctement

                    if(($password == $confirmPassword) and strlen($password) >= 12){
                    // Verifie si le password et le confirmPassword est identique et que la longeur du mdp est de mini 12

                        $manager = new UserManager();
                        $user = $manager->findOneByNickname($nickname);

                        if(!$user){

                            $hash = password_hash($password, PASSWORD_DEFAULT);
                            // ici on utilise une fonction pour "hasher" le mot de passe avec le hash par défaut de php

                            if($manager->add([
                                "nickname" => $nickname,
                                "mail" => $mail, 
                                "password" => $hash,
                                "role" => json_encode("ROLE_USER")])) // cela nous permet de donner le role user par défaut pour les nouveaux users
                                {   
                                    header('Location:index.php?ctrl=home');
                                }
                                return [
                                "view" => VIEW_DIR."security/login.php", 
                                ]; 
                            }
                        }
                    }else{
                        echo "Erreur : tous les champs sont requis.";
                    }
                }else {
                    echo "Le formulaire n'a pas été soumis.";
                }
        }

        public function loginForm(){ // fonction qui retourne la vue login

            return [
                "view" => VIEW_DIR."security/login.php", 
                "data" => null,
            ]; 
        }

        public function login(){ // fonction qui sert a se connecter a la session

            if(!empty($_POST)){

                //filtrer les donnés saisie dans les formulaires 
                $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                

                if($nickname && $password){ // Si le nickame et le password est filtré :
                    
                    $manager= new UserManager();
                    $user = $manager ->findOneByNickname($nickname);
    
                    if ($user){
    
                        if(password_verify($password, $user->getPassword())){
    
                            SESSION::setUser($user); 
                            
                            SESSION::addFlash("success", "connected"); 
                            $this->redirectTo("home", "home");                            
                                
                        }else {
    
                            SESSION::addFlash("error", "username or password incorrect"); 
                                
                            return [
                                "view" => VIEW_DIR . "security/login.php",
                                "data" => null,
                            ];
                        }
    
                    }
                }
            }
        }

        public function logout(){ // fonction déconnexion qui détruit la session actuel lors de l'appuie de l'input déconnexion donc le déconnecte.

            session_destroy();
            
            $this->redirectTo("view", "index");
        }

        public function banUser($id){

            $userManager = new UserManager();
    
            if($id){
    
                $user = $userManager->findOneById($id);
    
                $userManager->sendDiscordPayloadOnUserBan($user->getUsername(), Session::getUser()->getUsername());
                $userManager->banUser($id);
                Session::addFlash('success', 'La personne a bien été banni !');
                $this->redirectTo('security', 'showProfile', $id);
            }else{
                Session::addFlash('error', 'Attention, on ne modifie pas l\'URL !');
                $this->redirectTo('forum', 'home');
            }
        }


    }