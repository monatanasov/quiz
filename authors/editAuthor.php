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
            // set blank name on input text field when submitting the form / $_POST
            $editableAuthorName = '';

            if ($_GET) {
                $intGetAuthorId = (int) $_GET['id'];
                $authorNameSql = "SELECT * FROM `authors` WHERE `id` = $intGetAuthorId";
                $authorNameQuery = mysqli_query($conn, $authorNameSql);

                while ($row = mysqli_fetch_assoc($authorNameQuery)) {
                    $editableAuthorName = $row['name'];
                    $_SESSION['editableAuthorId'] = (int) $row['id'];
                }

                // TODO: check if exists

            } else if ($_POST) {
                $errors = [];
                $postAuthorName = trim($_POST['authorName']);
                $authorNameLength = mb_strlen($postAuthorName);
                $authorId = $_SESSION['editableAuthorId'];

                $authorCheckQuery = "SELECT * FROM `authors` WHERE `name` = '$postAuthorName'";
                $authorCheckResult = mysqli_query($conn,$authorCheckQuery);

                if (!$authorNameLength >= 1 && !$authorNameLength <=255) {
                    $errors[] =  'Author name must be between 1 and 255 characters long!' . '<br>';
                }

                if (mysqli_num_rows($authorCheckResult) >= 1) {
                    $errors[] = 'This Author already exists!' . '<br>';
                }

                if (empty($errors)) {
                    $updateAuthorSql = "UPDATE `authors` SET `name`='$postAuthorName' WHERE `id` = $authorId";
                    mysqli_query($conn,$updateAuthorSql);
                    echo 'Your Author was successfully edited!';

                    if (mysqli_error($conn)) {
                        echo 'No database connection in editAuthor page';
                        exit;
                    }
                } else {
                    $editableAuthorName = $postAuthorName;
                    foreach ($errors as $error) {
                        echo $error;
                    }
                }
            }
        ?>
        <form action="editAuthor.php" method="POST">
            <h2>Edit Author</h2>
            <div id="editAuthorDiv">
                <b><label for="editAuthorName">Author name</label></b>
                <?php echo '<input type="text" class="editAuthorName" id="editAuthorName" name="authorName" value="'.
                    $editableAuthorName .'">'?>
                <input type="submit" class="editAuthor" value="Update">
            </div>
        </form>
    </body>
</html>
