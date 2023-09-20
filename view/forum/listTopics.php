<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="description" content="Découvrez un monde de sujets fascinants - visitez notre page de la liste des topics et explorez des discussions enrichissantes.">
    <title>List Topics</title>
  </head>
    <body>
      <main>
        <?php
        $topics = $result["data"]['topics'];

        ?>

        <h1 style="text-align: center; color: orange; margin-bottom: 30px">Listes des topics</h1>
          
            <?php foreach($topics as $topic){
        // var_dump($topic);?>
          <div class="main-card" >
            <div class="card">
              <div class="card-body">
                <h3 class="card-title" style = "text-align: center; color: orange;"><?=$topic->getTitle()?></h3>
                <p style = "text-align: center; color: orange;"><?=$topic->getCreationdate()." ".$topic->getUser()->getNickname()?></p>
                <a href="index.php?ctrl=forum&action=viewPostFromTopic&id=<?=$topic->getId()?> class=" style="display: flex;justify-content: center; margin: 0 20px;">Aller vers le topic</a>
              </div>
            </div>
          </div>
        </div>

        <?php
        }
        ?>
      </main>
      <footer>

      </footer>
    </body>
</html>
<?php


