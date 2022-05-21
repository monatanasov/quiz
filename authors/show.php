<?php
    session_start();
    include '../dbconn.php';
    mb_internal_encoding("UTF-8");
?>
<html lang="en">
    <head>
        <meta charset="UTF-8" >
        <link rel="stylesheet" href="../css/myquiz.css">
        <title>Show Author</title>
    </head>
    <body>
        <a href="./index.php">Authors</a><br>

        <?php
            // set blank name on input text field when submitting the form / $_POST
            $authorName = '';
            $intGetAuthorId = '';

            if ($_GET) {
                $intGetAuthorId = (int)$_GET['id'];
                $authorsSql = "SELECT * FROM `authors` WHERE `id` = $intGetAuthorId";
                $authorsQuery = mysqli_query($conn, $authorsSql);

                if (mysqli_num_rows($authorsQuery) === 1) {
                    while ($row = mysqli_fetch_assoc($authorsQuery)) {
                        $authorName = $row['name'];
                        $authorId = (int)$row['id'];
                    }
                    echo '<h3>Author info</h3>';
                    echo '<p>Name: '. $authorName .' </p>';

                    echo '<form action="delete.php" method="POST">';
                        echo '<input type="text" name="authorId" value="'.$intGetAuthorId.'" readonly hidden>';
                        echo '<input type="submit" value="delete">';
                    echo '</form>';

                    echo '<form action="show.php" method="POST">';
                        echo '<input type="text" name="authorName" value="'.$authorName.'" readonly hidden>';
                        echo '<input type="submit" value="update">';
                    echo '</form>';
                }
            }

            if ($_POST) {
                echo '<form action="edit.php" method="POST">';
                echo '<div class="showAuthorsDiv">';
                echo '<h3>Author info</h3>';
                echo '<label for="updateAuthor">Name: </label>';
                echo '<input type="text" name="updateAuthor" id="updateAuthor" value="'.$_POST['authorName'].'">';
                echo '<input type="submit" value="update">';
                echo '</div>';
                echo '</form>';
            }
        ?>
    </body>
</html>
