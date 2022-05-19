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
            $editableAuthorName = '';

            if ($_GET) {
                $intGetAuthorId = (int)$_GET['id'];
                $authorNameSql = "SELECT * FROM `authors` WHERE `id` = $intGetAuthorId";
                $authorNameQuery = mysqli_query($conn, $authorNameSql);

                while ($row = mysqli_fetch_assoc($authorNameQuery)) {
                    $editableAuthorName = $row['name'];
                    $_SESSION['editableAuthorId'] = (int)$row['id'];
                }
            }
        ?>
    </body>
</html>

<form action="showAuthor.php" method="POST">
    <h2>Author info</h2>
    <div id="showAuthorDiv">
        <?php
            echo '<p></p>';
        ?>
        <input type="submit" class="editAuthor" value="Edit">
    </div>
</form>
