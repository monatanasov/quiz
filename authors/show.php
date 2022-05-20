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
            $intGetAuthorId = '';
            if ($_GET) {
                $intGetAuthorId = (int)$_GET['id'];
                $authorNameSql = "SELECT * FROM `authors` WHERE `id` = $intGetAuthorId";
                $authorNameQuery = mysqli_query($conn, $authorNameSql);

                if (mysqli_num_rows($authorNameQuery) === 1) {
                    while ($row = mysqli_fetch_assoc($authorNameQuery)) {
                        $authorName = $row['name'];
                        $authorId = (int)$row['id'];
                    }
                }
            }

            echo '<h3>Author info</h3>';
            echo '<p>Name: '. $authorName .' </p>';

            echo '<form action="delete.php" method="POST">';
                echo '<input type="text" name="authorId" value="'.$intGetAuthorId.'" readonly hidden>';
                echo '<input type="submit" value="delete">';
            echo '</form>';
        ?>
    </body>
</html>
