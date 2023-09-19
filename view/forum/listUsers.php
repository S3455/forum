<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <title>Document</title>
    </head>
    <body>
        <?php

        $users = $result["data"]['users'];
            
        ?>

        <h1>Liste users</h1>

        <?php

        foreach($users as $user ){
        // var_dump($user);
            ?>
            <p><?=$user->getNickname()." ".$user->getMail()." ".$user->getdateregis()?></p>
            
            <?php
        }   
            ?>
    </body>
</html>




