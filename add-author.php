<?php

include './dbconn.php';

if ($_POST) {
    $errors = [];
    $name = trim($_POST['name']);

    if (
        strlen($name) > 0
        && strlen($name) <= 255
    ) {
        // check if exists
        $checkQuery = mysqli_query($conn, "SELECT * FROM `authors` WHERE `name` = '$name'");

        $existingAuthors = [];
        while (
            $row = mysqli_fetch_assoc($checkQuery)
        ) {
            $existingAuthors[] = $row;
        }

        if (empty($existingAuthors)) {
            if (! mysqli_query($conn, "INSERT INTO `authors` (`id`, `name`) VALUES (NULL, '$name')")) {
                echo("Error description: " . mysqli_error($conn));
            }
        } else {
            $errors['name'] = "this name already exists";
        }
    } else {
        $errors['name'] = "name must be between 1 and 255 characters";
    }
}

?>
<html lang="en">
<head>
  <link rel="stylesheet" href="./css/myquiz.css">
    <meta charset="UTF-8" >
    <title>Binary mode quiz</title>
</head>
<body>
<?php
    $postedName = '';

    if ($_POST) {
        if (empty($errors)) {
            // success
            echo '<h3>Success</h3>';
        } else {
            $postedName = $_POST['name'];
            echo '<h2>ERROR WHILE STORING</h2>';

            if ($_POST['name']) {
                echo '<p>Error while adding '. $_POST['name'] .'</p>';
            }

            foreach ($errors as $key => $error) {
                echo '<p>'. $error .'</p>';
            }
        }
    }
?>
<h2>Add author</h2>
<form action="add-author.php" method="POST">
    <?php echo 'Name: <input type="text" name="name" value="'.$postedName.'"><br>'; ?>
    <input type="submit">
</form>
</body>
