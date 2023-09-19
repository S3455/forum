<?php

$posts = $result["data"]['posts'];
    
?>

<h1 style="text-align: center; color: orange; margin-bottom: 30px">Listes des posts</h1>



<?php foreach($posts as $post ){
            // var_dump($post);?>
<div class="container" style="display: flex;flex-wrap: wrap; margin: 20px;">
    <div class="card">
    <div class="card-header">
    <?=$post->getUser()->getNickname()?>
    </div>
        <div class="card-body">
            <blockquote class="#">
            <p><?=$post->getText()?></p>
            <footer class="#"><cite title="Source Title">Poster à <?=$post->getdatecreate()?></cite>
            </footer>
            </blockquote>
        </div>
    </div>
</div>
<?php   
}
?>