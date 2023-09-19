<?php

// Défini que $topics est égale a résult qui contienne data et topics

$topics = $result["data"]['topics'];

?>

<!-- Titre List des topics -->

<h1 style="text-align: center; color: black; margin-bottom: 30px">Listes des topics</h1>
  
<!-- div avec une boucle foreach qui affiche les topics actuel dans la bdd -->
<div class="" style="display: flex;flex-wrap: wrap;">
    <?php foreach($topics as $topic){
?>

<!-- Tout ce qui est nécessaire  a l'affichage d'un post, c'est a dire , le titre l'user, la date l'id -->
  <div class="main-card" >
    <div class="card">
      <div class="card-body">
        <h3 class="card-title" style = "text-align: center; color: orange;"><?=$topic->getTitle()?></h3>
        <p style = "text-align: center; color: white;"><?=$topic->getCreationdate()." ".$topic->getUser()->getNickname()?></p>
        <a href="index.php?ctrl=forum&action=viewPostFromTopic&id=<?=$topic->getId()?>" class="#" style="display: flex;justify-content: center; margin: 0 20px;">Aller vers les posts</a>
      </div>
    </div>
  </div>
</div>

<?php
}

// Si Il y 'a une session ouverte afficher le bouton Add qui permant d'ajouter une catégory 
if(App\Session::getUser()){
  ?>
  
  <form action="index.php?ctrl=forum&action=addTopic&id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
      
      <input type="text" name="title" placeholder="name topic" required>

      <textarea name="text" placeholder="Message 1e post" required></textarea>
  
      <button type="submit">ADD</button>
  
  </form>
  
  <?php
  }
  ?>