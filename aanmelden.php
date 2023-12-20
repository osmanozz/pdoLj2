<?php
    include 'db.php';

    try {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = new Database();
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $db->aanmelden($_POST['naam'], $_POST['achternaam'],$_POST['geboortedatum'], $_POST['email'], $hash);
            header("Location:login.php?accountAangemaakt");
        } 
    } catch (\Exception $e) {
        echo "Error: ".$e->getMessage();
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
    <div class="d-flex flex-column align-items-center">
    <h1>Register</h1>
    <form method="POST">
    <div class="mb-3">
        <input type="text" name="naam" placeholder="Naam" required>
    </div>
    <div class="mb-3">
        <input type="text" name="achternaam" placeholder="Achternaam" required>
    </div>
    <div class="mb-3">
        <input type="date" name="geboortedatum" required>
    </div>
    <div class="mb-3">
        <input type="text" name="email" placeholder="Email" required>
    </div>
    <div class="mb-3">
        <input type="password" name="password" placeholder="Password" required>
    </div>
        <input type="submit" class="btn btn-primary">
    </form>
    </div>
</body>
</html>