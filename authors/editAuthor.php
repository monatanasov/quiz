<?php
    // TODO: where should I put session_destroy?
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
            //set blank name when submitting the form / $_POST
            $editableAuthorName = '';

            if ($_GET) {
                $intGetAuthorId = (int) $_GET['id'];
                $authorNameSql = "SELECT * FROM `authors` WHERE `id` = $intGetAuthorId";
                $authorNameQuery = mysqli_query($conn, $authorNameSql);

                while ($row = mysqli_fetch_assoc($authorNameQuery)) {
                    $editableAuthorName = $row['name'];
                    $_SESSION['authorId'] = (int) $row['id'];
                }

            } else if ($_POST) {
                $postAuthorName = trim($_POST['authorName']);
                $authorId = $_SESSION['authorId'];
                $updateAuthorSql = "UPDATE `authors` SET `name`='$postAuthorName' WHERE `id` = $authorId";
                mysqli_query($conn,$updateAuthorSql);
                echo 'Your Author was successfully edited';

                if (mysqli_error($conn)) {
                    echo 'No database connection in editAuthor page';
                    exit;
                }
            }
        ?>
        <form action="editAuthor.php" method="POST">
            <h2>Edit Author</h2>
            <div id="addAuthorDiv">
                <b><label for="editAuthorName">Author name</label></b>
                <?php echo '<input type="text" class="editAuthorName" id="editAuthorName" name="authorName" value="'.
                    $editableAuthorName .'">'?>
                <input type="submit" class="submitAuthor">
            </div>
        </form>
    </body>
</html>
