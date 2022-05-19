<?php
    session_start();
    include '../dbconn.php';
    mb_internal_encoding("UTF-8");
?>
<html lang="en">
    <head>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="./css/myquiz.css">
        <title>Edit Author</title>
    </head>
    <body>
        <a href="./index.php">Authors</a><br>

        <?php
            // set blank name on input text field when submitting the form / $_POST
            $authorName = '';

            if ($_GET) {
                $intGetAuthorId = (int)$_GET['id'];
                $authorNameSql = "SELECT * FROM `authors` WHERE `id` = $intGetAuthorId";
                $authorNameQuery = mysqli_query($conn, $authorNameSql);

                while ($row = mysqli_fetch_assoc($authorNameQuery)) {
                    $authorName = $row['name'];
                    $authorId = (int)$row['id'];
                }
            }

            echo '<p>Name: '. $authorName .' </p>';
        ?>
    </body>
</html>
