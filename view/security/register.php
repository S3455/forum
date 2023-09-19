<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Inscrivez‑vous à LevelUp Lounge pour voir les dernières nouveautés...">
        <title>S'inscrire</title>
    </head>
    <body>
        <main>
        <form action="index.php?ctrl=security&action=register" method="post" enctype="multipart/form-data">
            
            <input type="text" name="nickname" placeholder="Nickname" required>

            <input type="mail" name="mail" placeholder="mail" required>

            <input type="password" name="password" placeholder="password" required>

            <input type="password" name="confirmPassword" placeholder="Confirm Password" required>

            <button type="submit">S'inscrire</button>
        </main>
    </form>
    </body>
</html>


