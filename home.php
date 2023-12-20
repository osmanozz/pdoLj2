<?php
include 'db.php';
session_start();

if (isset($_SESSION['userId'])) {
    echo "Ingelogd als: " . $_SESSION['userId'];
    echo "<br><a href=logout.php>Logout</a>";
} else {
    header("Location:login.php");
    exit();
}

try {
   $db = new Database();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // voer de functie insertUser uit en sla de return waarde op.
        $insertId = $db->insertUser($_POST['email'], $hash);
        // print de lastInsertId
        echo "Successfully added " . $insertId;
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <br> <br><br>
    <h1>Toevoegen</h1>
    <form method="POST">
        <input type="text" name="email" placeholder="Email"> <br> 
        <input type="password" name="password" placeholder="Password"> <br>
        <input type="submit">
    </form>
<br><br><br><br>
    <table class="table dark">
        <tr>
            <th>id</th>
            <th>email</th>
            <th>password</th>
            <th colspan="2">Action</th>
        </tr>

        <tr> <?php
            $users = $db->selectAllUsers(); 
            if ($users) { 
                foreach ($users as $user) {?>
            <td><?php echo $user['id'];?></td>
            <td><?php echo $user['email']?></td>
            <td><?php echo $user['password']?></td>
           <td><a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a></td>
           <td><a href="delete.php?id=<?php echo $user['id']; ?>">Delete</a></td>
           <td></td>
        </tr> <?php } }?>
    </table>
</body>
</html>