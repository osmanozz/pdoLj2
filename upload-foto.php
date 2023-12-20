<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedTypes)) {
            $name = $_FILES['file']['name'];
            $targetFilePath = "img/" . $name;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $db->upload($name);
            } else {
                echo "Er is een probleem opgetreden bij het verplaatsen van het bestand.";
            }
        } else {
            echo "Alleen JPG, JPEG, PNG en GIF-bestanden zijn toegestaan.";
        }
    } else {
        echo "Er is een probleem opgetreden bij het uploaden van het bestand.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit">
    </form>
</body>
</html>