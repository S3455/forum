<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Connectez‑vous à LevelUp Lounge pour voir les dernières nouveautés...">
    <title>Login</title>
</head>
<body>
    <form action="index.php?ctrl=security&action=login" method="post" enctype="multipart/form-data">
        
        <input type="text" name="nickname" placeholder="Nickname" required>

        <!-- <input type="email" name="mail" placeholder="email" required> -->

        <input type="password" name="password" placeholder="Password" required>

        <!-- <input type="password" name="confirmPassword" placeholder="Confirm password" required> -->

        <button type="submit">Connect</button>

    </form>
</body>
</html>



