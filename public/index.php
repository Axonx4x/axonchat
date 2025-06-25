<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();


require_once __DIR__. '/../config/database.php';

$page=$_GET['page'] ?? 'home';

switch ($page){
    case 'home':
        require_once __DIR__. '/../views/home.php';
        break;
    case 'login':
        require_once __DIR__. '/../views/login.php';
        break;
    
case 'register':

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

       
        if (!$username || !$email || !$password) {
            $msg = '<p style="color:red;">All fields are required.</p>';
        } else {
           
            $dupe = $pdo->prepare(
                "SELECT id FROM users WHERE username = ? OR email = ?"
            );
            $dupe->execute([$username, $email]);

            if ($dupe->rowCount() > 0) {
                $msg = '<p style="color:red;">Username or email already exists.</p>';
            } else {
              
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $add  = $pdo->prepare(
                    "INSERT INTO users (username, email, password)
                     VALUES (?, ?, ?)"
                );
                $add->execute([$username, $email, $hash]);

           
                header('Location: ?page=login&new=1');
                exit;
            }
        }
    }

 
    if (!empty($msg)) echo $msg;
    require_once __DIR__ . '/../views/register.php';
    break;


       
    default:
    echo '404 Page not found';
    break;

}

?>