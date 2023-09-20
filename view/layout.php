<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>FORUM</title>
</head>
<body>
    <div id="wrapper"> 
       
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
            <header>
                <nav>
                    <div id="nav-left">
                        <a href="view/home.php">Accueil</a>
                        <a href="index.php?ctrl=forum">la liste des topics</a>
                        <a href="index.php?ctrl=forum&action=viewAllPost">la liste des posts</a>
                        <a href="index.php?ctrl=forum&action=viewCat">la liste des categories</a>
                        <?php
                        if(App\Session::isAdmin()){
                            ?>
                            <a href="index.php?ctrl=forum&action=viewAllUser">la liste des users</a>
                            
                          
                            <?php
                        }
                        ?>
                    </div>
                    <div id="nav-right">
                    <?php
                        
                        if(App\Session::getUser()){
                            ?>
                            <a href="/security/viewProfile.html"><?= App\Session::getUser()->getNickname()?></a>
                            <a href="index.php?ctrl=security&action=logout">Déconnexion</a>
                            <?php
                        }else{
                            ?>
                            <a href="index.php?ctrl=security&action=loginForm">Connexion</a>
                            <a href="index.php?ctrl=security&action=registerForm">Inscription</a>
                        <?php
                        }
                    ?>
                    </div>
                </nav>
            </header>
            
            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer>
            <p>&copy; 2020 - Forum CDA - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></p>
        </footer>
    </div>
</body>
</html>