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
    <title>Delete Author</title>
</head>
    <body>
        <a href="./index.php">Authors</a><br>

        <?php
            // set blank name on input text field when submitting the form / $_POST
            $deletableAuthorName = '';

            if ($_GET) {
                $intGetAuthorId = (int) $_GET['id'];
                $authorNameSql = "SELECT * FROM `authors` WHERE `id` = $intGetAuthorId";
                $authorNameQuery = mysqli_query($conn, $authorNameSql);

                while ($row = mysqli_fetch_assoc($authorNameQuery)) {
                    $deletableAuthorName = $row['name'];
                    $_SESSION['deletableAuthorId'] = (int) $row['id'];
                }

            } else if ($_POST) {
                $postAuthorName = trim($_POST['authorName']);
                $authorId = $_SESSION['deletableAuthorId'];
                $deleteAuthorSql = "DELETE FROM `authors` WHERE `id` = $authorId AND `name` = '$postAuthorName'";
                mysqli_query($conn,$deleteAuthorSql);
                echo 'Your Author was successfully deleted!';

                if (mysqli_error($conn)) {
                    echo 'No database connection in deleteAuthor page';
                    exit;
                }
                session_destroy(); // TODO: sess_dest here?
            }
        ?>
        <form action="deleteAuthor.php" method="POST">
            <h2>Delete Author</h2>
            <div id="deleteAuthorDiv">
                <b><label for="deleteAuthorName">Author for deletion</label></b>
                <?php echo '<input type="text" class="deleteAuthorName" id="deleteAuthorName" name="authorName" value="' . $deletableAuthorName . '" readonly>'?>
                <input type="submit" onclick="return confirm('Are you sure? This action cannot be undone!')" class="deleteAuthor" value="Delete">
            </div>
        </form>
    </body>
</html>
