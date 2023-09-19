<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="description" content="Découvrez une multitude de catégories passionnantes - explorez notre page de la liste des catégories et plongez dans un monde de discussions variées.">
    <title>Liste des catégories</title>
  </head>
  <body>
    <main>
      <?
      
      $cats = $result["data"]['cats'];

      ?>
      <h1 style="text-align: center; color: black; margin-bottom: 30px">Listes des catégories</h1>


      <div class="container" style="display: flex;flex-wrap: wrap;">

      <?php foreach($cats as $cat){ ?>

        <div class="#">
          <img style= "height:100px;" src="public\img\<?=$cat->getImg()?>" class="card-img-top">
          <div class="#">
            <h3 class="#" style="text-align: center; "><a style="color: orange;" href="index.php?ctrl=forum&action=viewCatByTopic&id=<?=$cat->getId()?>"><?=$cat->getName()?></a><br></h3>
          </div>
        </div>

      <?php
      }
      ?>

      <button class="#" style=" display: flex;justify-content: center; margin: auto; margin-bottom: 30px;"><a style="color: black;" href="index.php?ctrl=forum&action=viewAddCat">New Category</a></button>
    </main>
    <footer>

    </footer>
  </body>
</html>
<?php

