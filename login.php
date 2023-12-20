<?php
    include 'db.php';

    try {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $db = new Database();
        $user = $db->login($email);

        if ($user) {
            $wachtwoord = $_POST['password'];
            $verify = password_verify($wachtwoord, $user['wachtwoord']);
            if ($user && $wachtwoord == $verify) {
                session_start();
                $_SESSION['userId'] = $user['id'];
                $_SESSION['naam'] = $user['naam'];
                $_SESSION['role'] = $user['role'];
                header('Location:home.php?ingelogd');
            } else {
                echo "incorrect username or email";
            }
        } else {
            echo "incorrect username or email";
        }
    }
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>