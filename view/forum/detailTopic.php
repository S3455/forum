<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Découvrez une myriade de sujets fascinants - explorez notre liste des sujets de topics et engagez-vous dans des discussions diverses et enrichissantes.">
        <title>Liste des topics de catégories</title>
    </head>
    <body>
        <main>
            <?php
            // Défini que $topics et post est égale a résult qui contienne data et topics et posts
            $topic = $result["data"]["topic"];
            $posts = $result["data"]['posts'];

            ?>

            <!-- Affiche le titre du sujet-->
            <h1 style="text-align: center; color: black; margin-bottom: 30px">Sujet : <?=$topic->getTitle()?></h1>


            <!-- Si la variable post est vide afficher pas encore de mess, si qlq chose afficher les posts avec la boucle -->
            <?php if (empty($posts)) {
                echo "Pas encore de messages posté.";
            } else {
                foreach ($posts as $post)
            // var_dump($posts);
                ?>


            <div class="container" style="display: flex;flex-wrap: wrap; margin: 20px;">
                <div class="card">
                <div class="card-header">
                    Message
                </div>
                    <div class="card-body">
                        <blockquote class="#">
                        <p style="witdh: 40%;"><?=$post->getText()?></p>
                        <footer class="#"><?=$post->getdatecreate()?><cite title="Source Title"><br><?=$post->getUser()->getNickname()?></cite>
                        </footer>
                        </blockquote>
                        <?php
                if($post->getUser()->getId() == App\Session::getUser()->getId() || App\Session::isAdmin()){?>

                    <button class="#" style="display: flex;justify-content: center; margin: auto; margin-bottom: 10px;"><a style="color: white;" href="index.php?ctrl=forum&action=viewModify&id=<?=$post->getId()?>&topic=<?= $topic->getId() ?>">Modify</a></button>
                    <button class="#" style="display: flex;justify-content: center; margin: auto; margin-bottom: 30px;"><a style="color: white;" href="index.php?ctrl=forum&action=deletePost&id=<?=$post->getId()?>">Delete</a></button>
                    <?php
                    }
                    ?>
                    </div>
                </div>
            </div>

            <?php
            }
            if(App\Session::getUser()){
            ?>
                
            <form action="index.php?ctrl=forum&action=addPost&id=<?=$topic->getId()?>" method="post" enctype="multipart/form-data">
            
                <textarea name="text" placeholder="New post" required></textarea>
                
                <button type="submit">ADD</button>
                
            </form>
                
            <?php
            }
            ?>
        </main>
        <footer>

        </footer>
    </body>
</html>l


