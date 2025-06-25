<!DOCTYPE html>
<html>
    <head> 
        <title>
            Login-AxonChat
        </title>
    </head>
    <body>
    <?php if (!empty($_GET['new'])): ?>
    <p style="color:green;">Registration successful — please log in.</p>
<?php endif; ?>

        <h2>Login Page</h2>
        <form method="post" action="#">
            <input type="text" name="username" placeholder="Username"><br><br>
            <input type="text" name="password" placeholder="password"><br><br>
            <button type="submit">Login</button>
        </form>
        
    </body>
</html>